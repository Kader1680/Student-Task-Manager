@extends('layouts.master')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-8">


        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-blue-800">Tasks for {{ $project->name }}</h1>
            <a href="{{ route('projects.tasks.create', $project) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                + Add Task
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 text-left border">Title</th>
                        <th class="p-3 text-center border">Status</th>
                        <th class="p-3 text-center border">Help</th>
                        <th class="p-3 text-center border">Reminder</th>
                        <th class="p-3 text-center border"> View Subtasks</th>

                        <th class="p-3 text-center border">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($tasks as $task)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border font-medium text-gray-800">{{ $task->title }}</td>
                            <td class="p-3 border text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-lg
                                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>

                             <td class="p-3 border text-center">
                                <a href="{{ route('tasks.ask', [$task->id]) }}"
                                   class="px-3 py-1 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600">
                                    Ask for Help
                                </a>
                            </td>


                            <td class="p-3 border text-center text-gray-600">
                                @if($task->reminder_at)
                                    {{ $task->reminder_at->format('d M Y, H:i') }}
                                @else
                                    <span class="text-gray-400">No reminder</span>
                                @endif
                            </td>

                            <td class="p-3 border text-center">
                                <a href="{{ route('tasks.subtasks.index', $task) }}"
                                class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                                    View Subtasks
                                </a>
                            </td>

                            <td class="p-3 border text-center flex justify-center gap-2">
                                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600"
                                            onclick="return confirm('Delete this task?')">
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
