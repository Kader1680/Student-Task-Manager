<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherDashboardController;

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

// Teacher Dashboard
Route::get('/dashboard-teacher', [TeacherDashboardController::class, 'index'])->middleware(['auth', 'role:teacher'])->name("teacher.dashboard");
//


Route::post('/dashboard-teacher', [TeacherDashboardController::class, 'storeReview'])
    ->middleware(['auth', 'role:teacher'])
    ->name("teacher.dashboard");


//  Route::post('/dashboard-teacher', [TeacherDashboardController::class, 'storeProject'])->middleware(['auth', 'role:teacher'])->name("teacher.dashboard");


// Route::middleware(['auth', 'role:teacher'])->group(function () {
// Route::get('/dashboard-teacher', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
// Route::post('/projects', [TeacherDashboardController::class, 'storeProject'])->name('projects.store');
// Route::post('/tasks/{task}/reviews', [TeacherDashboardController::class, 'storeReview'])->name('tasks.reviews.store');
// Route::post('/tasks/{task}/help', [TeacherDashboardController::class, 'storeHelp'])->name('tasks.help.store');
// });


Route::get('/dashboard-student  ',
function () {
    return "helow from teacher dashboard ";
}
)->middleware(['auth', 'role:student']);
