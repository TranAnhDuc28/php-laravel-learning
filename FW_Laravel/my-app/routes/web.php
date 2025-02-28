<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(Controller::class)
    ->name('posts.')
    ->prefix('posts')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('show/{id}', 'show')->name('show');;
        Route::delete('/create', 'create')->name('create');;
        Route::post('/store', 'store')->name('store');;
        Route::put('edit/{id}', 'edit')->name('edit');;
        Route::put('update/{id}', 'update')->name('update');;
    });
