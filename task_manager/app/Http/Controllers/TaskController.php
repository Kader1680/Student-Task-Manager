<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Review;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks;



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

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($request->only('title', 'description', 'status'));

        return redirect()->route('projects.tasks.index', $project)
                         ->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.tasks.index', $project)
                         ->with('success', 'Task deleted successfully.');
    }
}
