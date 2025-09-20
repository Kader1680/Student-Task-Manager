<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
public function index(Project $project)
{
    return view('projects.calendar', compact('project'));
}

public function calendarEvents(Project $project)
{
    $tasks = $project->tasks()->whereNotNull('reminder_at')->get();

    $events = $tasks->map(function($task) {
        return [
            'title' => $task->title,
            'start' => $task->reminder_at->format('Y-m-d\TH:i:s'),
        ];
    });

    return response()->json($events);
}


}
