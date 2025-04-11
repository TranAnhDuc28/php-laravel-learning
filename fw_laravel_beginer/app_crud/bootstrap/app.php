<?php

use App\Http\Middleware\AfterMiddleware;
use App\Http\Middleware\BeforeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            BeforeMiddleware::class,
            AfterMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
