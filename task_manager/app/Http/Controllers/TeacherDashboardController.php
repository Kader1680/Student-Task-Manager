<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller{
public function index(){
$students = User::query()->where('role', 'student')->orderBy('name')->get(['id','name']);
$tasks = Task::query()->latest()->get(['id','title']);
$reviews = Review::with("tasks")->get();
$projects = Project::with("users")->where("teacher_id", Auth::id())->get();
return view('teacher.dashboard', compact('students','tasks', 'reviews', 'projects'));
}


public function storeProject(Request $request)
{


$validated = $request->validate([
'title' => ['required','string','max:255'],
'description' => ['nullable','string'],
'deadline' => ['date','after:now'],

// 'user_id' => ['required'],
]);


$teacher_id = Auth::user()->id;
Project::create([
'title' => $validated['title'],
'description' => $validated['description'] ?? null,

'teacher_id'  => $teacher_id,
'deadline'  => $validated['deadline'],
]);


return back()->with('status', 'Project created for student successfully.');
}


public function storeReview(Request $request)
{
    $validated = $request->validate([
        'task_id'  => 'required|integer',
        'feedback' => 'required',
    ]);

    $teacher_id = Auth::user()->id;

    Review::create([
        'task_id'    => $validated['task_id'],
        'teacher_id' => $teacher_id,
        'feedback'   => $validated['feedback'],
    ]);

    return back()->with('success', 'Review submitted successfully!');
}



        public function traking()
        {

        $traking = Task::with('project')->get();

        return view('teacher.traking', compact('traking'));


        }


public function studentsAll()
    {

        $students = User::with(['projects.tasks'])->get();

        return view('teacher.students', compact('students'));
    }

    public function showTasks($id)
    {
        $student = User::with(['projects.tasks'])->findOrFail($id);

        return view('teacher.tasks', compact('student'));
    }


}
