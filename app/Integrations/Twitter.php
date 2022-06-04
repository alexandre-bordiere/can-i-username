<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class Twitter extends Integration
{
    /**
     * Check if the given username is available for this integration.
     *
     * @param  string  $username
     * @return bool
     */
    public function isUsernameAvailable(string $username): bool
    {
        $data = Http::withToken(config('services.twitter.token'))
            ->get("https://api.twitter.com/2/users/by/username/{$username}")
            ->json('data');

        return is_null($data);
    }
}
