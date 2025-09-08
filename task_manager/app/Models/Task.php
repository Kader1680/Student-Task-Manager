<?php

namespace App\Models;
use App\Jobs\SendTaskReminder;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title','description','status','project_id', "reminder_at"];
    protected $casts = [
    'reminder_at' => 'datetime',
];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

   public function reviews()
    {
        return $this->hasMany(Review::class, 'task_id', 'id');
    }

  public function helps()
    {
        return $this->hasMany(Help::class);
    }


public function subtasks()
{
    return $this->hasMany(Subtask::class);
}


protected static function boot()
{
    parent::boot();

    static::saved(function ($task) {
        if ($task->reminder_at) {
            SendTaskReminder::dispatch($task)
                ->delay($task->reminder_at);
        }
    });
}


}
