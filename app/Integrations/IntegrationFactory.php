<?php

namespace App\Integrations;

use App\Enums\Integration as IntegrationEnum;

class IntegrationFactory
{
    /**
     * Build a new integration instance.
     *
     * @return Integration
     */
    public function build(IntegrationEnum $integration): Integration
    {
        return match ($integration) {
            IntegrationEnum::Twitch => new Twitch(),
            IntegrationEnum::Twitter => new Twitter()
        };
    }
}
