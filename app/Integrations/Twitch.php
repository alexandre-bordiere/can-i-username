<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Cache;
use TwitchApi\HelixGuzzleClient;
use TwitchApi\TwitchApi;

class Twitch extends Integration
{
    /**
     * The interface used to communicate with the Twitch API.
     *
     * @var TwitchApi
     */
    protected TwitchApi $twitchApi;

    /**
     * Create a new integration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $clientId = config('services.twitch.client_id');
        $clientSecret = config('services.twitch.client_secret');

        $this->twitchApi = new TwitchApi(
            new HelixGuzzleClient($clientId),
            $clientId,
            $clientSecret
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
        if (!Cache::has('twitchToken')) {
            $accessToken = json_decode(
                $this->twitchApi
                    ->getOauthApi()
                    ->getAppAccessToken()
                    ->getBody()
                    ->getContents()
            );

            Cache::put('twitchToken', $accessToken->access_token, $accessToken->expires_in);
        }

        $data = json_decode(
            $this->twitchApi
                ->getUsersApi()
                ->getUserByUsername(Cache::get('twitchToken'), $username)
                ->getBody()
                ->getContents()
        )->data;

        return count($data) === 0;
    }
}
