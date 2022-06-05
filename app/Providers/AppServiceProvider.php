<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TwitchApi\HelixGuzzleClient;
use TwitchApi\TwitchApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TwitchApi::class, function () {
            $clientId = config('services.twitch.client_id');
            $clientSecret = config('services.twitch.client_secret');

            return new TwitchApi(
                new HelixGuzzleClient($clientId),
                $clientId,
                $clientSecret
            );
        });
    }
}
