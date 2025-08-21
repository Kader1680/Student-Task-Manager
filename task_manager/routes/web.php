<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('projects', ProjectController::class);
Route::resource('projects.tasks', TaskController::class);

});


// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

