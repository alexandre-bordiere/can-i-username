<?php

use App\Http\Controllers\IntegrationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('/integrations', [IntegrationController::class, 'index']);
Route::get('/integrations/{integration}/is-username-available', [IntegrationController::class, 'isUsernameAvailable']);
