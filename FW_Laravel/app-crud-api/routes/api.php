<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/v1.php';
});

Route::prefix('v2')->group(function () {
    require __DIR__ . '/api/v2.php';
});
