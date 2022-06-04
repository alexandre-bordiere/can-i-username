<?php

namespace App\Http\Controllers;

use App\Enums\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
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
     * @param  Integration $integration
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function isUsernameAvailable(Integration $integration, Request $request)
    {
        $isUsernameAvailable = $integration->build()->isUsernameAvailable(
            $request->input('username')
        );

        return response('', $isUsernameAvailable ? 204 : 422);
    }
}
