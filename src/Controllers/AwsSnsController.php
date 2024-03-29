<?php

namespace JoggApp\AwsSns\Controllers;

use Aws\Sns\Exception\InvalidSnsMessageException;
use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use JoggApp\AwsSns\Events\SnsMessageReceived;
use JoggApp\AwsSns\Events\SnsTopicSubscriptionConfirmed;

class AwsSnsController
{
    public function __invoke()
    {
        $message = Message::fromRawPostData();

        $validator = new MessageValidator(function ($certUrl) {
            return Cache::rememberForever($certUrl, function () use ($certUrl) {
                return Http::get($certUrl)->body();
            });
        });

        try {
            $validator->validate($message);
        } catch (InvalidSnsMessageException $e) {
            // Return 404 to pretend we are not here for SNS if invalid request
            return response('SNS Message Validation Error: ' . $e->getMessage(), 404);
        }

        if (isset($message['Type']) && $message['Type'] === 'SubscriptionConfirmation') {
            // Confirm the subscription by sending a GET request to the SubscribeURL
            Http::get($message['SubscribeURL']);

            event(new SnsTopicSubscriptionConfirmed);

            return response('OK', 200);
        }

        if (isset($message['Type']) && $message['Type'] === 'Notification') {
            event(new SnsMessageReceived($message));
        }

        return response('OK', 200);
    }
}
