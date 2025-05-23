<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Test\PhotoController;
use App\Http\Controllers\Test\ProvisionServer;
use App\Http\Controllers\TestController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
//    $token = csrf_token();

//    $post = \App\Models\Post::query()->find(5);

//    event(new \App\Events\PodcastProcessed('hello'));

    \App\Events\EventTest1::dispatch();
    \App\Events\EventTest2::dispatch();

    return view('welcome');
});
//    ->middleware(EnsureTokenIsValid::class) // Assigning Middleware to Routes
//    ->middleware(\App\Http\Middleware\EnsureUserHasRole::class.':user,admin');


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


/*
 * PostController
 */
Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/post', [PostController::class, 'store'])->name('post.store');

/*
 * Flight
 */
Route::get('/flight', function () {
    Flight::query()->create([
        'name' => 'Flight 1',
    ]);

    return view('welcome');
});


/**
 * send mail with event queue
 */
Route::get('/send-mail', function () {

    \App\Events\OrderSuccess::dispatch(array('name' => "ABC"));

    return view('welcome');
});
