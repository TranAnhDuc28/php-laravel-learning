<?php

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {  // Registering Middleware
        /*
         * Global Middleware
         * Middleware to run during every HTTP request to your application
         */
        // $middleware->append(EnsureTokenIsValid::class);

        /*
         * Manually Managing Laravel's Default Global Middleware
         */
//        $middleware->use([
//            \Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class,
            // \Illuminate\Http\Middleware\TrustHosts::class,
//            \Illuminate\Http\Middleware\TrustProxies::class,
//            \Illuminate\Http\Middleware\HandleCors::class,
//            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
//            \Illuminate\Http\Middleware\ValidatePostSize::class,
//            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
//            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
//        ]);

        /*
         * Excluding URIs From CSRF Protection
         */
//        $middleware->validateCsrfTokens(except: [
//            'stripe/*',
//            'http://example.com/foo/bar',
//            'http://example.com/foo/*',
//        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
