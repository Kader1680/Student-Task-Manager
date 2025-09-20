@extends('layouts.master')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-800">Subtasks for: {{ $task->title }}</h2>
        <a href="{{ route('tasks.subtasks.create', $task) }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
            + Add Subtask
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left border">Title</th>
                    <th class="p-3 text-center border">Status</th>
                    <th class="p-3 text-center border">Reminder</th>
                    <th class="p-3 text-center border">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($subtasks as $subtask)
                    <tr class="hover:bg-gray-50">
                        <!-- Title -->
                        <td class="p-3 border font-medium text-gray-800">
                            {{ $subtask->title }}
                        </td>

                        <!-- Status -->
                        <td class="p-3 border text-center">
                            @if ($subtask->status === 'completed')
                                <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-green-100 text-green-700">
                                    {{ ucfirst($subtask->status) }}
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-yellow-100 text-yellow-700">
                                    {{ ucfirst($subtask->status) }}
                                </span>
                            @endif
                        </td>

                        <!-- Reminder -->
                        <td class="p-3 border text-center">
                            @if ($subtask->reminder_at)
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $diffInMinutes = $now->diffInMinutes($subtask->reminder_at, false);
                                @endphp

                                @if ($diffInMinutes < 0)
                                    <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-red-100 text-red-700">
                                        Expired
                                    </span>
                                @elseif ($diffInMinutes < 60)
                                    <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-blue-100 text-blue-700">
                                        {{ $diffInMinutes }} min
                                    </span>
                                @elseif ($diffInMinutes < 1440)
                                    <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-green-100 text-green-700">
                                        {{ floor($diffInMinutes / 60) }}h
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-purple-100 text-purple-700">
                                        {{ floor($diffInMinutes / 1440) }}d
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-400">No reminder</span>
                            @endif
                        </td>

                        <td class="p-3 border text-center flex justify-center gap-2">
                            <a href="{{ route('tasks.subtasks.edit', [$task, $subtask]) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('tasks.subtasks.destroy', [$task, $subtask]) }}"
                                  method="POST" onsubmit="return confirm('Delete this subtask?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
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
@endsection
