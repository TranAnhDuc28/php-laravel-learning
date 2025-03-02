<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Test\PhotoController;
use App\Http\Controllers\Test\ProvisionServer;
use App\Http\Controllers\TestController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    $token = csrf_token();
    return view('welcome');
})
//    ->middleware(EnsureTokenIsValid::class) // Assigning Middleware to Routes
    ->middleware(\App\Http\Middleware\EnsureUserHasRole::class.':user,admin');


Route::controller(Controller::class)
    ->name('posts.')
    ->prefix('posts')
    ->group(function () {
//        Route::get('/', 'index')->name('index');
        Route::get('show/{id}', 'show')->name('show');;
        Route::delete('/create', 'create')->name('create');;
        Route::post('/store', 'store')->name('store');;
        Route::put('edit/{id}', 'edit')->name('edit');;
        Route::put('update/{id}', 'update')->name('update');;
    });


/*
 * Excluding Middleware
 * Note: The withoutMiddleware method can only remove route middleware and does not apply to global middleware.
 */
Route::withoutMiddleware([EnsureTokenIsValid::class])->group(function () {
    Route::get('/abc', function () {
        // ...
    });
});

/*
 * Single Action Controllers
 */
Route::post('/server', ProvisionServer::class);


/*
 * Resource Controllers
 */
Route::resource('photos', PhotoController::class);

/*
 * Test
 */
//Route::resource('/test', TestController::class);
Route::match(['get', 'post'], '/test', [TestController::class, 'index']);


/*
 * Template
 */
Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
