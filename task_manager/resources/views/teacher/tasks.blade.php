@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">
         Tasks of {{ $student->name }}
    </h2>

    @foreach ($student->projects as $project)
        <div class="mb-8 bg-white shadow rounded-lg">
            <div class="px-4 py-3 border-b bg-gray-100 font-semibold">
                {{ $project->title }} ({{ $project->tasks->count() }} tasks)
            </div>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-sm text-gray-700">
                        <th class="px-3 py-2 border">Task</th>
                        <th class="px-3 py-2 border">Status</th>
                        <th class="px-3 py-2 border">Deadline</th>
                        <th class="px-3 py-2 border">Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->tasks as $task)
                        <tr class="hover:bg-gray-50 text-sm">
                            <td class="px-3 py-2 border">{{ $task->title }}</td>
                            <td class="px-3 py-2 border">
                                @if($task->status === 'completed')
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Completed</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Pending</span>
                                @endif
                            </td>
                            <td class="px-3 py-2 border reminder" data-date="{{ $task->reminder_at }}">
                                {{ $task->reminder_at ?? '—' }}
                            </td>
                            <td class="px-3 py-2 border days-left">—</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();

        document.querySelectorAll(".reminder").forEach(reminderCell => {
            const daysLeftCell = reminderCell.closest("tr").querySelector(".days-left");
            const reminderDate = reminderCell.dataset.date;

            if (reminderDate) {
                const reminder = new Date(reminderDate);
                const diffTime = reminder - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    daysLeftCell.innerHTML = `<span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">${diffDays} days left</span>`;
                } else if (diffDays === 0) {
                    daysLeftCell.innerHTML = `<span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">Today</span>`;
                } else {
                    daysLeftCell.innerHTML = `<span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">${Math.abs(diffDays)} days overdue</span>`;
                }
            } else {
                daysLeftCell.textContent = "—";
            }
        });
    });
</script>
@endsection
