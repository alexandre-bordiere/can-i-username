<?php

namespace App\Enums;

use App\Integrations\Integration as BaseIntegration;
use App\Integrations\Twitter;

enum Integration: string
{
    case Twitter = 'twitter';

    /**
     * Create a new integration instance.
     *
     * @return BaseIntegration
     */
    public function build(): BaseIntegration
    {
        return match ($this) {
            static::Twitter => new Twitter()
        };
    }
}
