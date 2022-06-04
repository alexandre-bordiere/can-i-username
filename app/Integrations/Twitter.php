<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Twitter extends Integration
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
        $this->accessToken = Config::get('services.twitter.token');
    }

    /**
     * Check if the given username is available for this integration.
     *
     * @param  string  $username
     * @return bool
     */
    public function isUsernameAvailable(string $username): bool
    {
        $data = Http::withToken($this->accessToken)
            ->get("https://api.twitter.com/2/users/by/username/{$username}")
            ->json('data');

        return is_null($data);
    }
}
