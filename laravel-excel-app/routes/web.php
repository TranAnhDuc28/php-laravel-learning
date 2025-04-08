<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('export-test', [TestController::class, 'exportTest'])->name('exportTest');

Route::get('demo', [DemoController::class, 'showViewDemo'])->name('showViewDemo');
Route::get('export-demo', [DemoController::class, 'exportDemo'])->name('exportDemo');


