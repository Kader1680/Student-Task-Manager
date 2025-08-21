@extends('layouts.master')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Task</h1>

<form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" class="bg-white p-4 shadow rounded">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input type="text" name="title" value="{{ $task->title }}" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea name="description" class="w-full border rounded p-2">{{ $task->description }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Status</label>
        <select name="status" class="w-full border rounded p-2">
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>
    <button class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
