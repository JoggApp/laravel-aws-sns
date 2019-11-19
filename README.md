# Laravel package for the AWS SNS Events

[![Latest Version](https://img.shields.io/github/release/JoggApp/laravel-aws-sns.svg?style=flat-rounded)](https://github.com/JoggApp/laravel-aws-sns/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/JoggApp/laravel-aws-sns.svg?style=flat-rounded&colorB=brightgreen)](https://packagist.org/packages/JoggApp/laravel-aws-sns)

Amazon Simple Notification Service (Amazon SNS) is a web service that coordinates and manages the delivery or sending of messages to subscribing endpoints or clients. The Amazon S3 notification feature enables you to receive notifications when certain events happen in your bucket.

This package ships with a controller that listens to the SNS notification incoming to one of your defined URL/endpoint. The controller takes care of validating the incoming request's signature & messages, confirming your endpoint's subscription to the SNS topic and also emits respective Laravel events. If you are using AWS SNS, all you have to do after installing this package is add your desired Laravel Listeners. The Listeners will automatically receive the SNS message. You are free to take control of the message after that to achieve your desired results. 

## Installation and Usage

- You can install this package via composer using this command:

```bash
composer require joggapp/laravel-aws-sns
```

- The package will automatically register itself.

- You then need to pass the route to `awsSnsWebhooks`:

```php
Route::awsSnsWebhooks('route-you-added-in-aws-sns-topic-subscription-console');
```

- The package emits 2 events: `SnsTopicSubscriptionConfirmed` & `SnsMessageReceived`.

- `SnsTopicSubscriptionConfirmed`: This event is fired once the endpoint's subscription to the SNS topic is confirmed.

- `SnsMessageReceived`: This event is fired everytime your endpoint receives a message (request) from AWS SNS.

- To use these events you will have to add the events in your `app/Providers/EventServiceProvider.php`

- You can access the SNS message in your listeners listening to the `SnsMessageReceived` event just like you would do in any other laravel listener:

```php
class SnsListener
{
    public function handle($event)
    {
        $event->message
    }
}
```

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## Security

If you discover any security related issues, please email them to [harish@jogg.co](mailto:harish@jogg.co) instead of using the issue tracker.

## Credits

- [Harish Toshniwal](https://github.com/introwit)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE.txt) for more information.
