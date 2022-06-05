<?php

namespace App\Integrations;

use App\Enums\Integration as IntegrationEnum;
use TwitchApi\TwitchApi;

class IntegrationFactory
{
    /**
     * The interface used to communicate with the Twitch API.
     *
     * @var TwitchApi
     */
    protected TwitchApi $twitchApi;

    /**
     * Create a new factory instance.
     *
     * @return void
     */
    public function __construct(TwitchApi $twitchApi)
    {
        $this->twitchApi = $twitchApi;
    }

    /**
     * Build a new integration instance.
     *
     * @return Integration
     */
    public function build(IntegrationEnum $integration): Integration
    {
        return match ($integration) {
            IntegrationEnum::Twitch => new Twitch($this->twitchApi),
            IntegrationEnum::Twitter => new Twitter()
        };
    }
}
