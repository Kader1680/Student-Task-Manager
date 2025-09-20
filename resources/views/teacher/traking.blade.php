@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Student Task Tracking</h2>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full border-collapse" id="taskTable">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-3 border">Task ID</th>
                    <th class="px-4 py-3 border">Task Title</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border">Reminder</th>
                    <th class="px-4 py-3 border">Days Left</th>
                    <th class="px-4 py-3 border">Project</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($traking as $trak)
                    <tr class="hover:bg-gray-50 text-sm">
                        <td class="px-4 py-3 border">{{ $trak['id'] }}</td>
                        <td class="px-4 py-3 border font-semibold">{{ $trak['title'] }}</td>
                        <td class="px-4 py-3 border">
                            @if($trak['status'] === 'completed')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Completed</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border reminder" data-date="{{ $trak['reminder_at'] }}">
                            {{ $trak['reminder_at'] ?? 'No Reminder' }}
                        </td>
                        <td class="px-4 py-3 border days-left">—</td>
                        <td class="px-4 py-3 border">
                            {{ $trak['project']['title'] ?? 'No Title' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

 <script>
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();

        document.querySelectorAll("#taskTable tbody tr").forEach(row => {
            const reminderCell = row.querySelector(".reminder");
            const daysLeftCell = row.querySelector(".days-left");
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
