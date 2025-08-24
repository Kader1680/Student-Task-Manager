<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title','description','status','project_id'];

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
}
