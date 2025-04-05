<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('export-demo', [DemoController::class, 'exportDemo'])->name('exportDemo');
Route::get('export-report', [ReportController::class, 'exportReport'])->name('exportReport');


