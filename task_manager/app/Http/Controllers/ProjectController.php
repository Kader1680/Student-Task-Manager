<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title'=>'required']);
        Project::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>auth()->id()
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
