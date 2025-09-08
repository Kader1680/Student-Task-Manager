<?php
namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\HelpCreated;

class HelpController extends Controller
{
    public function helps_student()
    {
        $student_id = Auth::id();
        $helps = Help::with('tasks','teacher')
                     ->where('student_id', $student_id)
                     ->get();

        return view('projects.helps', compact('helps'));
    }

    public function helps_teacher()
    {
        $teacher_id = Auth::id();
        $helps = Help::with('tasks','student')
                     ->where('teacher_id', $teacher_id)
                     ->get();

        return view('teacher.help_student', compact('helps'));
    }

    // Example store method — broadcast here after creating a single Help
    public function store(Request $request)
    {
        $help = Help::create([
            'student_id' => Auth::id(),
            'teacher_id' => $request->teacher_id,
            'task_id'    => $request->task_id,
            // any other fields...
        ]);

        // Broadcast the single new help (to others)
        broadcast(new HelpCreated($help))->toOthers();

        return redirect()->route('helps_student'); // or back()
    }

    public function viewrepley(Task $task, Help $help)
    {
        $helps = Help::with('tasks','student')->get();
        return view('teacher.repley', compact('helps','task','help'));
    }

    public function repley(Request $request, Help $help)
    {
        $help->update($request->only('response'));
        return redirect('/helps-teacher');
    }
}
