<?php
namespace App\Jobs;

use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendTaskReminder implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function handle()
    {
        $student = $this->task->assigned_student; // Adjust as needed
        if ($student) {
            $student->notify(new TaskReminderNotification($this->task));
        }
    }
}
