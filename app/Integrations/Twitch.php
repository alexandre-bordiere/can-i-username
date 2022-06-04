<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Twitch extends Integration
{
    /**
     * The access token used to authenticate our requests.
     *
     * @var string
     */
    protected string $accessToken;

    /**
     * Create a new integration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->accessToken = Cache::remember(
            'twitchAccessToken',
            3600,
            fn () => Http::post('https://id.twitch.tv/oauth2/token', [
                'client_id' => Config::get('services.twitch.client_id'),
                'client_secret' => Config::get('services.twitch.client_secret'),
                'grant_type' => 'client_credentials',
            ])->json('access_token')
        );
    }

    /**
     * Check if the given username is available for this integration.
     *
     * @param  string  $username
     * @return bool
     */
    public function isUsernameAvailable(string $username): bool
    {
        $data = Http::withHeaders(['Client-Id' => Config::get('services.twitch.client_id')])
            ->withToken($this->accessToken)
            ->get('https://api.twitch.tv/helix/users', ['login' => $username])
            ->json('data');

        return count($data) === 0;
    }
}
