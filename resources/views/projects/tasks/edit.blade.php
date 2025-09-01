@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6"> Edit Task</h1>

    <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" 
          class="bg-white p-6 shadow-lg rounded-2xl border border-gray-100">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block mb-2 text-gray-700 font-semibold">Task Title</label>
            <input type="text" 
                   name="title" 
                   value="{{ $task->title }}" 
                   class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                   required>
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-gray-700 font-semibold">Description</label>
            <textarea name="description" 
                      rows="4" 
                      class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ $task->description }}</textarea>
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-gray-700 font-semibold">Status</label>
            <select name="status" 
                    class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}> Pending</option>
                <option value="in_progress" {{ $task->status == 'progress' ? 'selected' : '' }}> In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}> Completed</option>
            </select>
        </div>

           <div class="mb-5">
                    <label for="reminder_at" class="block mb-2 text-gray-700 font-semibold">Reminder</label>
                    <input type="datetime-local" name="reminder_at" id="reminder_at" 
                           value="{{ old('reminder_at', $task->reminder_at ? $task->reminder_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>


        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow-md transition">
                💾 Update Task
            </button>
            <a href="{{ route('projects.tasks.index', $project) }}" 
               class="text-gray-600 hover:text-gray-800 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
