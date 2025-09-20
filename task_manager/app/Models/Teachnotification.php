<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teachnotification extends Model
{
        protected $fillable = [
        'teacher_id',
        'student_id',
        'task_id',
        'message',
        'is_read',
    ];


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
