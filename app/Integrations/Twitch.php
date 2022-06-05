<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;
use TwitchApi\TwitchApi;

class Twitch extends Integration
{
    const TWITCH_TOKEN_CACHE_KEY = '';

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
    public function __construct(TwitchApi $twitchApi)
    {
        $this->twitchApi = $twitchApi;
    }

    /**
     * Check if the given username is available for this integration.
     *
     * @param  string  $username
     * @return bool
     */
    public function isUsernameAvailable(string $username): bool
    {
        $accessToken = $this->fetchAndStoreOAuthToken();

        $data = $this->transformResponseToJson(
            $this->twitchApi->getUsersApi()->getUserByUsername($accessToken, $username)
        );

        return count($data->data) === 0;
    }

    /**
     * Fetch an OAuth token and store it into the cache.
     *
     * @return string
     */
    protected function fetchAndStoreOAuthToken(): string
    {
        if (! Cache::has(self::TWITCH_TOKEN_CACHE_KEY)) {
            $accessToken = $this->transformResponseToJson(
                $this->twitchApi->getOauthApi()->getAppAccessToken()
            );

            Cache::put(self::TWITCH_TOKEN_CACHE_KEY, $accessToken->access_token, $accessToken->expires_in);
        }

        return Cache::get(self::TWITCH_TOKEN_CACHE_KEY);
    }

    /**
     * Transform the response's data into a JSON object.
     *
     * @param  ResponseInterface  $response
     * @return mixed
     */
    protected function transformResponseToJson(ResponseInterface $response): mixed
    {
        return json_decode($response->getBody()->getContents());
    }
}
