<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('login', [AuthenticationController::class, 'processLogin'])->name('processLogin');

Route::get('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('register', [AuthenticationController::class, 'processRegister'])->name('processRegister');

Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('member', [MemberController::class, 'dashboard'])
    ->name('member.dashboard')
    ->middleware(['auth', IsMember::class]);

Route::get('admin', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth', IsAdmin::class]);

Route::resource('products', ProductController::class);
