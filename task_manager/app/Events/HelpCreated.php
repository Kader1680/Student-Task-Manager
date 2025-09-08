<?php
namespace App\Events;

use App\Models\Help;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class HelpCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $help;

    public function __construct(Help $help)
    {
        $this->help = $help;
    }

    // use public channel 'helps' so all connected users can listen (easy for testing)
    public function broadcastOn()
    {
        return new Channel('helps');
    }

    public function broadcastAs()
    {
        return 'HelpCreated';
    }

    // Optional: only send needed fields
    public function broadcastWith()
    {
        return [
            'id' => $this->help->id,
            'student_id' => $this->help->student_id,
            'teacher_id' => $this->help->teacher_id,
        ];
    }
}
