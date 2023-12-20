<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuzzleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind('GuzzleHttp\Client', function($app){

            return new \GuzzleHttp\Client([

                'verify' => "C:/wamp64/bin/php/php8.2.0/extras/ssl/cacert.pem"

            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
