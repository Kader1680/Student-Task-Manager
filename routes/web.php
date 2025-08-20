<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});





// Route::prefix('api')->group(function () {
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::middleware('auth:api')->get('/profile', [AuthController::class, 'profile']);
//     Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
// });
