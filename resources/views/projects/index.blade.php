@extends('layouts.master')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-8">
        
         <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-blue-800">Projects</h1>
            <a href="{{ route('projects.create') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                + Add Project
            </a>
        </div>

         @if(session('success'))
            <div class="p-3 mb-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

         <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 text-left border">Title</th>
                        <th class="p-3 text-left border">Description</th>
                        <th class="p-3 text-center border">Tasks</th>
                   
                        <th class="p-3 text-center border">View Task</th>
                        <th class="p-3 text-center border">Create Task</th>
                        <th class="p-3 text-center border">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border font-medium text-gray-800">{{ $project->title }}</td>
                            <td class="p-3 border text-gray-600">{{ $project->description }}</td>
                            <td class="p-3 border text-center">{{ $project->tasks->count() }}</td>
                             <td class="p-3 border text-center">
                                <a href="{{ route('projects.tasks.index', $project) }}" 
                                   class="px-3 py-1 bg-gray-500 text-white rounded-lg text-sm hover:bg-gray-600">
                                    View
                                </a>
                            </td>
                            <td class="p-3 border text-center">
                                <a href="{{ route('projects.tasks.store', $project) }}" 
                                   class="px-3 py-1 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600">
                                    Create
                                </a>
                            </td>
                            <td class="p-3 border text-center flex justify-center gap-2">
                                <a href="{{ route('projects.edit',$project) }}" 
                                   class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('projects.destroy',$project) }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600"
                                            onclick="return confirm('Are you sure you want to delete this project?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
