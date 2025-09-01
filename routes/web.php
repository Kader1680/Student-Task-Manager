<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherDashboardController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

 


});

Route::middleware(['auth', 'role:student'])->group(function () {
 
   Route::resource('projects', ProjectController::class);
   Route::resource('projects.tasks', TaskController::class);
 
});


// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Teacher Dashboard
Route::get('/dashboard-teacher', [TeacherDashboardController::class, 'index'])->middleware(['auth', 'role:teacher'])->name("teacher.dashboard");
//


Route::post('/dashboard-teacher', [TeacherDashboardController::class, 'storeReview'])
    ->middleware(['auth', 'role:teacher'])
    ->name("teacher.dashboard");

 
Route::middleware(['auth', 'role:teacher'])->group(function () {
Route::get('/dashboard-teacher', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
Route::post('/teacher-project', [TeacherDashboardController::class, 'storeProject'])->name('teacher.store');
Route::post('/tasks/{task}/reviews', [TeacherDashboardController::class, 'storeReview'])->name('tasks.reviews.store');
Route::post('/tasks/{task}/help', [TeacherDashboardController::class, 'storeHelp'])->name('tasks.help.store');
});


 


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/tasks/{id}/ask', [TaskController::class, 'askView'])->name('tasks.ask');

    Route::post('/tasks/{id}/ask', [TaskController::class, 'ask'])->name('tasks.ask.store');
     Route::get('/helps', [HelpController::class, 'helps_student']);

});
 

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/helps-teacher', [HelpController::class, 'helps_teacher']);
    Route::get('/helps-teacher/{help}/reply', [HelpController::class, 'viewrepley'])->name("helps-teacher.reply.form");
    Route::put('/helps-teacher/{help}/reply', [HelpController::class, 'repley'])->name("helps-teacher.reply");

});
