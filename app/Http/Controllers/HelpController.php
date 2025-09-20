<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\Teachnotification;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\HelpRepliedNotification;
use App\Notifications\HelpCreatedNotification; // Add this import

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

    public function store(Request $request)
    {
        // Create the help request
        $help = Help::create([
            'student_id' => Auth::id(),
            'teacher_id' => $request->teacher_id,
            'task_id'    => $request->task_id,
        ]);

        // Notify the teacher about the new help request
        $teacher = User::find($request->teacher_id);
        if ($teacher) {
            $teacher->notify(new HelpCreatedNotification($help));
        }

        return redirect()->route('helps_student');
    }

    public function viewrepley(Task $task, Help $help)
    {
        $helps = Help::with('tasks','student')->get();
        return view('teacher.repley', compact('helps','task','help'));
    }

    public function repley(Request $request, Help $help)
    {
        $help->update($request->only('response'));

        // Notify the student
        $student = User::find($help->student_id);
        $student->notify(new HelpRepliedNotification($help));

        return redirect('/helps-teacher');
    }

    public function teacherNotifications()
    {
        $teacher_id = Auth::id();

        $notifications = Teachnotification::where('teacher_id', $teacher_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('teacher.notifications', compact('notifications'));
    }
}
