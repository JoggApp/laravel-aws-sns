<?php

namespace JoggApp\AwsSns\Events;

use Aws\Sns\Message;
use Illuminate\Queue\SerializesModels;

class SnsMessageReceived
{
    use SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
}
