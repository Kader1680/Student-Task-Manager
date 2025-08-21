<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',   // 👈 add api route file
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

->withMiddleware(function (Middleware $middleware): void {
    // Web group
    $middleware->group('web', [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,

        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);

    // API group
    $middleware->group('api', [
        // Sanctum (needed for SPA cookie auth only)
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);
})



    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
