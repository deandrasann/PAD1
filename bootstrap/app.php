<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'level' => \App\Http\Middleware\loginlevel::class,
            'auth' => Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' =>    Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' =>    Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' =>    Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' =>    Illuminate\Auth\Middleware\Authorize::class,
            'guest' =>    Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
