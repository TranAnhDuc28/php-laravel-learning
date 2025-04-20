// Calendar routes
Route::prefix('apps/calendar')->group(function () {
    Route::get('/', [CalendarAppController::class, 'showMainCalendar'])->name('apps.calendar.main');
    Route::get('/events', [CalendarAppController::class, 'listEvents'])->name('apps.calendar.events.list');
    Route::post('/events', [CalendarAppController::class, 'store'])->name('apps.calendar.events.store');
    Route::put('/events/{event}', [CalendarAppController::class, 'update'])->name('apps.calendar.events.update');
    Route::delete('/events/{event}', [CalendarAppController::class, 'destroy'])->name('apps.calendar.events.destroy');
}); 