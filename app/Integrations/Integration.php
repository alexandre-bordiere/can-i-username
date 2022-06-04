<?php

namespace App\Integrations;

abstract class Integration
{
    /**
     * Check if the given username is available for this integration.
     *
     * @param  string  $username
     * @return bool
     */
    abstract public function isUsernameAvailable(string $username): bool;
}
