<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Review;
use App\Models\User;
use App\Models\Help;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Logging\TeamCity;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

     public function index(Project $project, Request $request)
    {

        $tasks = $project->tasks()->with('reviews')->get();
        return view('projects.tasks.index', compact('project', 'tasks'));


    }

    public function create(Project $project)
    {
        return view('projects.tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reminder_at' => 'nullable|date|after:now',

        ]);



    $project->tasks()->create($request->only('title', 'description', 'reminder_at'));

        return redirect()->route('projects.tasks.index', $project)
                         ->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('projects.tasks.edit', compact('project', 'task'));
    }
    public function askView($id)
    {
        $task = Task::find($id);
        $teachers =User::where('role', 'teacher')->get();

        return view('projects.tasks.help.ask', compact( 'task', 'teachers'));
    }

   public function ask(Request $request, $id, Project $project,)
{
    $student_id = Auth::id();
    $task = Task::findOrFail($id);

    Help::create([
        'task_id'   => $task->id,
        'student_id'=> $student_id,
        'content' =>   $request->content,
        'teacher_id'=> $request->teacher_id,
    ]);

    return redirect("/helps")

        ->with('success', 'Help request sent successfully.');
}



    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,progress,completed',

            'reminder_at' => 'nullable|date|after:now',

        ]);

        $task->update($request->only('title', 'description', 'status', 'reminder_at'));

        return redirect()->route('projects.tasks.index', $project->id)
                         ->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.tasks.index', $project)
                         ->with('success', 'Task deleted successfully.');
    }
}
