@extends('layouts.master')

@section('title', 'My Calendar')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">My Task Calendar</h2>
    <div id="calendar"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: "{{ route('projects.calendar.events', $project->id) }}",
        eventColor: '#2563eb',
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        }
    });
    calendar.render();
console.log("calendar");
});
</script>
@endsection
