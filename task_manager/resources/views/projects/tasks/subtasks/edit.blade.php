@extends('layouts.master')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">Edit Subtask: {{ $subtask->title }}</h2>
    <form method="POST" action="{{ route('tasks.subtasks.update', [$task, $subtask]) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" value="{{ $subtask->title }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="pending" {{ $subtask->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $subtask->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-5">
                <label for="reminder_at" class="block mb-2 text-gray-700 font-semibold">Reminder</label>
                <input type="datetime-local" name="reminder_at" id="reminder_at"
                        value="{{ old('reminder_at', $subtask->reminder_at ? date('Y-m-d\TH:i', strtotime($subtask->reminder_at)) : '') }}"

                        class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update Subtask</button>
    </form>
</div>
@endsection
