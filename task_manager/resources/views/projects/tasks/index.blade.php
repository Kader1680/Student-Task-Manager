@extends('layouts.master')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tasks for {{ $project->name }}</h1>

    <a href="{{ route('projects.tasks.create', $project) }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">Add Task</a>

    <table class="w-full mt-4 bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2">Title</th>
                <th class="p-2">Status</th>
                <th class="p-2">Ask for help</th>
                <th class="p-2">Feedback</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr class="border-b">
                    <td class="p-2">{{ $task->title }}</td>
                    <td class="p-2">{{ ucfirst($task->status) }}</td>

                    {{-- Ask for help --}}
                    <td class="p-2">
                        <form action=" " method="POST" class="flex space-x-2">
                            @csrf
                            <select name="teacher" class="border rounded p-1">
                                <option value="">Select Teacher</option>
                                <option value="Mr. Smith">Mr. Smith</option>
                                <option value="Mrs. Johnson">Mrs. Johnson</option>
                                <option value="Dr. Brown">Dr. Brown</option>
                            </select>

                            <input type="text" name="message" placeholder="Message"
                                   class="border rounded p-1" />

                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">
                                Send
                            </button>
                        </form>
                    </td>

                    {{-- Teacher feedback (dummy data for now) --}}
                    <td class="p-2">

                        @php
                            // Fake feedback examples
                            $feedbackSamples = [
                                "Try to use CSS flex",
                                "Add more comments in your code",
                                "Good start, improve naming conventions",
                                "Consider using a database relation here"
                            ];
                            $feedback = $feedbackSamples[array_rand($feedbackSamples)];
                        @endphp
                        <span class="text-sm text-gray-700 italic">{{ $feedback }}</span>
                    </td>

                    {{-- Actions --}}
                    <td class="p-2 space-x-2">
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500" onclick="return confirm('Delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
