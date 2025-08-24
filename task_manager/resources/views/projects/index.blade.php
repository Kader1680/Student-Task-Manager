@extends('layouts.master')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Projects</h1>
    <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">+ Add Project</a>
</div>

@if(session('success'))
    <div class="p-2 bg-green-200 text-green-800 mb-2">{{ session('success') }}</div>
@endif

<table class="w-full border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Title</th>
            <th class="p-2 border">Description</th>
            <th class="p-2 border">Tasks</th>
            <th class="p-2 border">Task</th>

            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td class="p-2 border">{{ $project->title }}</td>
            <td class="p-2 border">{{ $project->description }}</td>
            <td class="p-2 border">{{ $project->tasks->count() }}</td>
            <td class="p-2 border">

                <a  href="{{ route('projects.tasks.store', $project) }}"   class="px-2 py-1 bg-green-500 text-white rounded">Create</a>

            </td>

            <td class="p-2 border flex gap-2">
                <a href="{{ route('projects.edit',$project) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <form method="POST" action="{{ route('projects.destroy',$project) }}">
                    @csrf @method('DELETE')
                    <button class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
