<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   protected $fillable = ['task_id','teacher_id','feedback'];

    public function task()
    {
return $this->belongsTo(Task::class, 'task_id', 'id');

    }
}
