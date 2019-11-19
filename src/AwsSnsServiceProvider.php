<?php

namespace JoggApp\AwsSns;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AwsSnsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::macro('awsSnsWebhooks', function ($url) {
            return Route::post($url, '\JoggApp\AwsSns\Controllers\AwsSnsController');
        });
    }

    public function register()
    {
        //
    }
}
