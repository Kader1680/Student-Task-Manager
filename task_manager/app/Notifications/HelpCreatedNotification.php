<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Help;

class HelpCreatedNotification extends Notification
{
    use Queueable;

    protected $help;

    public function __construct(Help $help)
    {
        $this->help = $help;
    }

    public function via($notifiable)
    {
        return ['database']; // save into DB
    }

    public function toDatabase($notifiable)
    {
        $studentName = "eee"; // Assuming you have a relationship

        return [
            'message' => "eeee",
            'task_id' => $this->help->task_id,
            'student_id' => $this->help->student_id,
            'teacher_id' => $this->help->teacher_id,
            'type' => 'help_request'
        ];
    }
}
