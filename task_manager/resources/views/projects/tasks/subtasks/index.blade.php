@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">Subtasks for: {{ $task->title }}</h2>
    <a href="{{ route('tasks.subtasks.create', $task) }}" class="bg-blue-600 text-white px-3 py-1 rounded">+ Add Subtask</a>
    <table class="w-full mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Reminder</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subtasks as $subtask)
                <tr>
                    <td>{{ $subtask->title }}</td>
                    <td>{{ ucfirst($subtask->status) }}</td>
                    <td>
                        @if($subtask->reminder_at)
                            {{ $subtask->reminder_at->format('d M Y, H:i') }}
                        @else
                            <span class="text-gray-400">No reminder</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tasks.subtasks.edit', [$task, $subtask]) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('tasks.subtasks.destroy', [$task, $subtask]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Delete this subtask?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
