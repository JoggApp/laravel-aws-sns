<?php

namespace JoggApp\AwsSns\Events;

use Illuminate\Queue\SerializesModels;

class SnsTopicSubscriptionConfirmed
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
