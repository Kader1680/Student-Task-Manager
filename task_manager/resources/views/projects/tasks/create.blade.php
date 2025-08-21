@extends('layouts.master')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add Task to {{ $project->name }}</h1>

<form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="bg-white p-4 shadow rounded">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea name="description" class="w-full border rounded p-2"></textarea>
    </div>
    <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection
