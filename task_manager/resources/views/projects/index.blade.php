@extends('layouts.master')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-8">

         <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-blue-800">Projects By Student</h1>
            <a href="{{ route('projects.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                + Add Project
            </a>
        </div>

         @if(session('success'))
            <div class="p-3 mb-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

         <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 text-left border">Title</th>
                        <th class="p-3 text-left border"> View Calenda</th>
                        <th class="p-3 text-left border">Description</th>
                        <th class="p-3 text-center border">Tasks</th>
                        <th class="p-3 text-center border">Deadline</th>

                        <th class="p-3 text-center border">View Task</th>
                        <th class="p-3 text-center border">Create Task</th>
                        <th class="p-3 text-center border">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border font-medium text-gray-800">{{ $project->title }}</td>

                        <td>
                            <a href="{{ route('projects.student.calendar', $project->id) }}"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                                View Calendar
                            </a>
                        </td>
                                                    <td class="p-3 border text-gray-600">{{ $project->description }}</td>
                            <td class="p-3 border text-center">{{ $project->tasks->count() }}</td>
                            <td class="p-3 border text-gray-600">

                <h4 class="text-lg font-semibold text-black-700 mb-4">
                 <span class="text-md font-semibold text-green-700" id="deadline-{{ $project->id }}">
                     {{ $project->deadline }}
                </span>
                <span class="text-md font-semibold text-blue-700" id="timeleft-{{ $project->id }}"> s</span>
                </h4>


                            </td>

                             <td class="p-3 border text-center">
                                <a href="{{ route('projects.tasks.index', $project) }}"
                                   class="px-3 py-1 bg-gray-500 text-white rounded-lg text-sm hover:bg-gray-600">
                                    View
                                </a>
                            </td>
                            <td class="p-3 border text-center">
                                <a href="{{ route('projects.tasks.store', $project) }}"
                                   class="px-3 py-1 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600">
                                    Create
                                </a>
                            </td>
                            <td class="p-3 border text-center flex justify-center gap-2">
                                <a href="{{ route('projects.edit',$project) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('projects.destroy',$project) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600"
                                            onclick="return confirm('Are you sure you want to delete this project?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>






 <h1 class=" mt-8 mb-5 text-2xl font-extrabold text-blue-800">Projects Created By Teacher</h1>



<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 bg-white rounded-lg shadow-md">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border text-left text-sm font-semibold text-gray-700">Title</th>

                <th class="px-4 py-2 border text-center text-sm font-semibold text-gray-700">Tasks</th>
                <th class="px-4 py-2 border text-center text-sm font-semibold text-gray-700">View</th>
                <th class="px-4 py-2 border text-center text-sm font-semibold text-gray-700">Create Task</th>
                <th class="px-4 py-2 border text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($projectByTeacher as $project)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 border text-gray-800 font-medium">{{ $project->title }}</td>

                    <td class="px-4 py-2 border text-center">{{ $project->tasks->count() }}</td>

                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('projects.tasks.index', $project) }}"
                           class="px-3 py-1 bg-gray-500 text-white rounded-lg text-sm hover:bg-gray-600">
                            View
                        </a>
                    </td>

                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('projects.tasks.store', $project) }}"
                           class="px-3 py-1 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600">
                            Create
                        </a>
                    </td>

                    <td class="px-4 py-2 border text-center flex justify-center gap-2">
                        <a href="{{ route('projects.edit',$project) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('projects.destroy',$project) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600"
                                    onclick="return confirm('Are you sure you want to delete this project?')">
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

<script>
function timeLeft(deadline) {
    const now = new Date();
    const end = new Date(deadline);

    let diff = end - now; // difference in ms

    if (diff <= 0) {
        return "Expired";
    }

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    diff -= days * (1000 * 60 * 60 * 24);

    const hours = Math.floor(diff / (1000 * 60 * 60));

    if (days > 0 && hours > 0) {
        return `${days} day${days > 1 ? "s" : ""} ${hours}h`;
    } else if (days > 0) {
        return `${days} day${days > 1 ? "s" : ""}`;
    } else {
        return `${hours}h`;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Select all deadlines
    const deadlines = document.querySelectorAll("[id^='deadline-']");

    deadlines.forEach(deadlineEl => {
        const projectId = deadlineEl.id.split("-")[1]; // get the project id
        const deadline = deadlineEl.innerText;
        const result = timeLeft(deadline);

        const timeLeftEl = document.getElementById("timeleft-" + projectId);
        if (timeLeftEl) {
            timeLeftEl.innerText = ` (${result})`;
        }
    });
});
</script>

@endsection
