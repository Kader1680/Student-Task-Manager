<?php

use App\Events\HelpCreated;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherDashboardController;
use App\Models\Project;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware(['auth', 'role:student'])->group(function () {

   Route::resource('projects', ProjectController::class);
   Route::resource('projects.tasks', TaskController::class);

});



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/dashboard-teacher', [TeacherDashboardController::class, 'index'])->middleware(['auth', 'role:teacher'])->name("teacher.dashboard");



Route::post('/dashboard-teacher', [TeacherDashboardController::class, 'storeReview'])
    ->middleware(['auth', 'role:teacher'])
    ->name("teacher.dashboard.review");


Route::middleware(['auth', 'role:teacher'])->group(function () {
Route::get('/dashboard-teacher', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');



Route::get('/dashboard-teacher/traking', [TeacherDashboardController::class, 'traking'])->name('teacher.dashboard');


Route::get('/students', [TeacherDashboardController::class, 'studentsAll'])->name('students.studentsAll');
Route::get('/students/{id}/tasks', [TeacherDashboardController::class, 'showTasks'])->name('students.tasks');



Route::post('/teacher-project', [TeacherDashboardController::class, 'storeProject'])->name('teacher.store');
Route::post('/tasks/{task}/reviews', [TeacherDashboardController::class, 'storeReview'])->name('tasks.reviews.store');
Route::post('/tasks/{task}/help', [TeacherDashboardController::class, 'storeHelp'])->name('tasks.help.store');
});





Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/tasks/{id}/ask', [TaskController::class, 'askView'])->name('tasks.ask');
    Route::get('/projects/{project}/calendar/events', [ProjectController::class, 'calendarEvents'])->name('projects.calendar.events');
    Route::post('/tasks/{id}/ask', [TaskController::class, 'ask'])->name('tasks.ask.store');
    Route::get('/helps', [HelpController::class, 'helps_student']);
    Route::get('/projects/{project}/student/calendar', [CalendarController::class, 'index'])
    ->name('projects.student.calendar');
    Route::get('/projects/{project}/calendar/events', [CalendarController::class, 'calendarEvents'])
        ->name('projects.calendar.events');

});


Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/helps-teacher', [HelpController::class, 'helps_teacher']);
    Route::get('/helps-teacher/{help}/reply', [HelpController::class, 'viewrepley'])->name("helps-teacher.reply.form");
    Route::put('/helps-teacher/{help}/reply', [HelpController::class, 'repley'])->name("helps-teacher.reply");
    Route::get('/project/{id}/download', [InvoiceController::class, 'generateInvoicePdf'])->name("project.download");
});



Route::middleware(['auth', 'role:student'])->prefix('tasks/{task}')->group(function () {
    Route::get('subtasks', [SubtaskController::class, 'index'])->name('tasks.subtasks.index');
    Route::get('subtasks/create', [SubtaskController::class, 'create'])->name('tasks.subtasks.create');
    Route::post('subtasks', [SubtaskController::class, 'store'])->name('tasks.subtasks.store');
    Route::get('subtasks/{subtask}/edit', [SubtaskController::class, 'edit'])->name('tasks.subtasks.edit');
    Route::put('subtasks/{subtask}', [SubtaskController::class, 'update'])->name('tasks.subtasks.update');
    Route::delete('subtasks/{subtask}', [SubtaskController::class, 'destroy'])->name('tasks.subtasks.destroy');




});

use Illuminate\Notifications\DatabaseNotification;

Route::post('/notification/delete', function (\Illuminate\Http\Request $request) {
    $user = Auth::user();
    $notificationId = $request->id;


    $notification = $user->notifications()->where('id', $notificationId)->first();
    if ($notification) {
        $notification->delete();
    }

    return back();  
})->name('delete');


use Illuminate\Support\Facades\Auth;
use App\Models\Task;

Route::get('/my-tasks', function () {
    $tasks = Task::whereHas('project', function ($query) {
        $query->where('user_id', Auth::id());
    })->get()->map(function ($task) {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'date' => $task->due_date ?? $task->created_at,
            'start' => $task->due_date ?? $task->created_at,
            'end' => $task->due_date ?? $task->created_at,
        ];
    });

    return response()->json($tasks);
})->name('tasks.json');

Route::view('/calendar', 'calendar')->middleware('auth');




?>
