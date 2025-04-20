<?php

use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;

// Calendar routes
Route::prefix('apps')->name('app.')->group(function () {
    /* Calendar API. */
    Route::prefix('calendar')->name('calendar.')->group(function () {
        Route::get('/events', [EventController::class, 'list'])->name('events.list');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });
});
