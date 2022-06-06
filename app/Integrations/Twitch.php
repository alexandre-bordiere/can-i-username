<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;
use TwitchApi\TwitchApi;

class Twitch extends Integration
{
    /**
     * The access token used to authenticate our requests.
     *
     * @var string
     */
    protected string $accessToken;

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

        $this->accessToken = Cache::remember(
            'twitchAccessToken',
            3600,
            fn () => $this->transformResponseToJson($this->twitchApi->getOauthApi()->getAppAccessToken())->access_token
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
        $data = $this->transformResponseToJson(
            $this->twitchApi->getUsersApi()->getUserByUsername($this->accessToken, $username)
        );

        return count($data->data) === 0;
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
