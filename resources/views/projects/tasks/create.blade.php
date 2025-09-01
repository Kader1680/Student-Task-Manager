@extends('layouts.master')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">

         <h1 class="text-2xl font-extrabold text-blue-800 mb-6">
            Add Task to {{ $project->name }}
        </h1>

         <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="space-y-5">
            @csrf

             <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                    Task Title
                </label>
                <input type="text" name="title" id="title" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700" 
                       placeholder="Enter task title" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

             <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Task Description
                </label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                          placeholder="Enter task details..."></textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                    <label for="reminder_at" class="block mb-2 text-gray-700 font-semibold">Reminder</label>
                    <input type="datetime-local" name="reminder_at" id="reminder_at" 
                           value="{{ old('reminder_at', $task->reminder_at ? $task->reminder_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>



             <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                    Save Task
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
