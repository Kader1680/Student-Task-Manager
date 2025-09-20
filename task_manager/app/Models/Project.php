<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title','description','user_id', "teacher_id", "deadline"];
protected $casts = [
        'deadline' => 'datetime',
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
