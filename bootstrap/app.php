<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure()
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware) {
            // Register your middleware here
            $middleware->alias([
                'auth' => \App\Http\Middleware\Authenticate::class,
                'admin' => \App\Http\Middleware\Admin::class, // Your custom admin middleware
            ]);
        })
        ->withExceptions(function (Exceptions $exceptions) {
            // Exception handling
        })
        ->create();
        
        // return Application::configure(basePath: dirname(__DIR__))
        //     ->withRouting(
        //         web: __DIR__.'/../routes/web.php',
        //         commands: __DIR__.'/../routes/console.php',
        //         health: '/up',
        //     )
        //     ->withMiddleware(function (Middleware $middleware) {
        //         //
        //     })
        //     ->withExceptions(function (Exceptions $exceptions) {
        //         //
        //     })->create();