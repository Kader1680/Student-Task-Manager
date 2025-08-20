<?php

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
    ->withMiddleware(function (Middleware $middleware): void {
        // Register your custom middleware alias
        $middleware->alias([
            'role' => App\Http\Middleware\CheckRole::class,
        ]);

        // Optional: You can also add middleware to groups if needed
        $middleware->appendToGroup('api', [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle JWT exceptions
        $exceptions->render(function (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['status' => 'Token is Invalid'], 401);
        });

        $exceptions->render(function (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['status' => 'Token is Expired'], 401);
        });

        $exceptions->render(function (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['status' => 'Authorization Token not found'], 401);
        });
    })->create();
