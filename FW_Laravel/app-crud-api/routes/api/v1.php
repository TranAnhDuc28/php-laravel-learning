<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class)->names([
    'index' => 'v1.users.index',
    'store' => 'v1.users.store',
    'show' => 'v1.users.show',
    'update' => 'v1.users.update',
    'destroy' => 'v1.users.destroy',
]);
