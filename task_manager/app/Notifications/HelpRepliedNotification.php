<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Help;

class HelpRepliedNotification extends Notification
{
    use Queueable;

    protected $help;

    public function __construct(Help $help)
    {
        $this->help = $help;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $teacherName = $this->help->teacher->name;

        return [
            'message' => "{$teacherName} replied to your help request for task #{$this->help->task_id}",
            'task_id' => $this->help->task_id,
            'teacher_id' => $this->help->teacher_id,
            'type' => 'help_reply'
        ];
    }
}
