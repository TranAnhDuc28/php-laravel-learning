<?php

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
        //
        $middleware->alias([
            'admin.mod' => \App\Http\Middleware\AdminMod::class,
            'admin.pu' => \App\Http\Middleware\AdminPu::class,
            'pu' => \App\Http\Middleware\PowerUser::class,
        ]);
//        $middleware->alias('prevent-duplicate-submission', \App\Http\Middleware\PreventDuplicateSubmission::class);
        $middleware->web([
            // ...other middleware
            \App\Http\Middleware\PreventDuplicateSubmission::class,
//            \App\Http\Middleware\VerifyCsrfToken::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
