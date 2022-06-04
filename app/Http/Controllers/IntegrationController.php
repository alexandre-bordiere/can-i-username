<?php

namespace App\Http\Controllers;

use App\Enums\Integration;
use App\Integrations\IntegrationFactory;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    /**
     * The factory to create a new integration instance.
     *
     * @var IntegrationFactory
     */
    protected IntegrationFactory $integrationFactory;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IntegrationFactory $integrationFactory)
    {
        $this->integrationFactory = $integrationFactory;
    }

    /**
     * Display a listing of integrations.
     *
     * @return array
     */
    public function index()
    {
        return Integration::cases();
    }

    /**
     * Check if a given username is avaiable for a given integration.
     *
     * @param  Integration  $integration
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function isUsernameAvailable(Integration $integration, Request $request)
    {
        $isUsernameAvailable = $this->integrationFactory
            ->build($integration)
            ->isUsernameAvailable(
                $request->input('username')
            );

        return response()->json(
            compact('isUsernameAvailable')
        );
    }
}
