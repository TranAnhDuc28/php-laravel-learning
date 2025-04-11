<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class)->names([
    'index' => 'v2.users.index',
    'store' => 'v2.users.store',
    'show' => 'v2.users.show',
    'update' => 'v2.users.update',
    'destroy' => 'v2.users.destroy',
]);
