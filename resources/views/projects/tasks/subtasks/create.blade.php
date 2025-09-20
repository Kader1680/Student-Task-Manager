@extends('layouts.master')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">Add Subtask to: {{ $task->title }}</h2>
    <form method="POST" action="{{ route('tasks.subtasks.store', $task) }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-5">

                <label for="reminder_at" class="block mb-2 text-gray-700 font-semibold">Reminder</label>
                <input type="datetime-local" name="reminder_at" id="reminder_at"
                        value="{{ old('reminder_at', $task->reminder_at ? $task->reminder_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Subtask</button>
    </form>
</div>
@endsection
