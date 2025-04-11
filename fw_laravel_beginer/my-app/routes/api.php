<?php

use Illuminate\Http\Request;

//Route::get('/test-rate-limiting', function (Request $request) {
//    return 'Test rate limiting.';
//})->middleware('throttle:api');


Route::middleware('throttle:api')
    ->name('api.')
    ->group(function () {
        Route::get('/test-rate-limiting', function (Request $request) {
            return 'Test rate limiting.';
        })->name('test-rate-limiting');
    });
