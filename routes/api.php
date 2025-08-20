<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Apply auth middleware to protected routes
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

// Protected routes with role-based access
Route::middleware('auth:api')->group(function () {

    // Accessible by both roles
    Route::get('dashboard', function () {
        return response()->json(['message' => 'Welcome to dashboard']);
    });

    // Teacher-only routes
    Route::middleware('role:teacher')->group(function () {
        Route::get('teacher/dashboard', function () {
            return response()->json(['message' => 'Teacher dashboard']);
        });
    });

    // Student-only routes
    Route::middleware('role:student')->group(function () {
        Route::get('student/dashboard', function () {
            return response()->json(['message' => 'Student dashboard']);
        });
    });
});
