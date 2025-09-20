<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function index(Task $task)
    {
        $subtasks = $task->subtasks;
        return view('projects.tasks.subtasks.index', compact('task', 'subtasks'));
    }

    public function create(Task $task)
    {
        return view('projects.tasks.subtasks.create', compact('task'));
    }

    public function store(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reminder_at' => 'required|date|after:now',
        ]);
        $task->subtasks()->create($request->only('title', 'reminder_at'));
        return redirect()->route('tasks.subtasks.index', $task)->with('success', 'Subtask created!');
    }

    public function edit(Task $task, Subtask $subtask)
    {
        return view('projects.tasks.subtasks.edit', compact('task', 'subtask'));
    }

    public function update(Request $request, Task $task, Subtask $subtask)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'reminder_at' => 'required|date|after:now',
        ]);
        $subtask->update($request->only('title', 'status', 'reminder_at'));
        return redirect()->route('tasks.subtasks.index', $task)->with('success', 'Subtask updated!');
    }

    public function destroy(Task $task, Subtask $subtask)
    {
        $subtask->delete();
        return redirect()->route('tasks.subtasks.index', $task)->with('success', 'Subtask deleted!');
    }
}
