<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function index()
    {
        $id_auth = Auth::id();
        $projects = Project::with('tasks')->where('user_id', $id_auth)->get();
        $projectByTeacher = Project::with('tasks')->where('user_id', null)->get();
        return view('projects.index', compact('projects', "projectByTeacher"));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title'=>'required',

        ]);
        Project::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'deadline'=>$request->deadline,
            'user_id'=>Auth::id(),
            'teacher_id'  => null
        ]);
        return redirect()->route('projects.index')->with('success','Project created');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->only('title','description'));
        return redirect()->route('projects.index')->with('success','Project updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success','Deleted');
    }
}
