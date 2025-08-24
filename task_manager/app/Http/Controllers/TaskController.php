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
        ]);

        $project->tasks()->create($request->only('title', 'description'));

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

   public function ask(Request $request, Project $project, Task $task)
{
    $student_id = Auth::id();

    Help::create([
        'task_id'   => 2,        // current task id
        'student_id'=> $student_id,
        'content' =>   $request->content,
        'teacher_id'=> $request->teacher_id, // selected teacher
    ]);

    return redirect()
        ->route('project.home', $project)
        ->with('success', 'Help request sent successfully.');
}



    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($request->only('title', 'description', 'status'));

        return redirect()->route('projects.tasks.index')
                         ->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.tasks.index', $project)
                         ->with('success', 'Task deleted successfully.');
    }
}
