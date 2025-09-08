<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    public $fillable = ['task_id', 'student_id', 'content', 'teacher_id', 'response'];

    public function tasks()
    {
        return $this->belongsTo(Task::class, "task_id");
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

     public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
