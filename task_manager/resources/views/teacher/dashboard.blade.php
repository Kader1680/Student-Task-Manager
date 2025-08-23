@extends('layouts.master')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">

     <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold">Create Project for Student</h2>
        <form action="{{route("teacher.dashboard")}}" method="POST" class="space-y-4">
            @csrf
            @php


                 $projects = [
                    ['title' => 'Math Analysis', 'student' => 'Alice Johnson'],
                    ['title' => 'Physics Simulation', 'student' => 'Bob Smith'],
                ];
            @endphp

            <div>
                <label for="user_id" class="mb-1 block text-sm font-medium">Select Student</label>
                <select name="user_id" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" required>
                    <option value="">Choose a student…</option>
                    @foreach($students as $s)
                        <option  value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="mb-1 block text-sm font-medium">Project Title</label>
                <input type="text" name="title" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" placeholder="Project title">
            </div>

            <button type="submit"  class="w-full rounded-2xl bg-sky-600 px-4 py-2 font-medium text-white shadow hover:bg-sky-700">Create Project</button>
        </form>

         <div class="mt-6">
            <h3 class="font-semibold mb-2">Created Projects ({{ count($projects) }})</h3>
            <ul class="list-disc list-inside space-y-1">
                @foreach($projects as $p)
                    <li><span class="font-medium">{{ $p['title'] }}</span> — for <span class="text-gray-600">{{ $p['student'] }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>


    {{-- Review Task --}}
    <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold">Add Review on Task</h2>
        <form action="{{route("teacher.dashboard")}}" method="POST" class="space-y-4"  >
            @csrf
            @php


                 $reviews = [
                    ['task' => 'Math Homework', 'review' => 'Good effort but improve steps'],
                    ['task' => 'Science Project', 'review' => 'Excellent detail and clear diagrams'],
                ];
            @endphp

            <div>
                <label for="task_id" class="mb-1 block text-sm font-medium">Select Task</label>
                <select name="task_id" id="review-task-select" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" required>
                    <option value="">Choose a task…</option>
                    @foreach($tasks as $t)
                        <option value="{{ $t['id'] }}">{{ $t['title'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="feedback" class="mb-1 block text-sm font-medium">Review Message</label>
                <textarea name="feedback" rows="4" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" placeholder="Your feedback…"></textarea>
            </div>

            <button type="submit" class="w-full rounded-2xl bg-sky-600 px-4 py-2 font-medium text-white shadow hover:bg-sky-700">Submit Review</button>
        </form>

        <div class="mt-6">
            <h3 class="font-semibold mb-2">Task Reviews ({{ count($reviews) }})</h3>
            <ul class="space-y-2">
                @foreach($reviews as $r)
                    <li class="border rounded-lg p-2">
                        <span class="font-medium">{{ $r['task'] }}:</span>
                        <span class="text-gray-600">{{ $r['review'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


    {{-- Help on Task --}}
    <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold">Send Help to Task</h2>
        <form action="{{route("teacher.dashboard")}}" method="POST" class="space-y-4" id="help-form">
            @csrf

            <div>
                <label class="mb-1 block text-sm font-medium">Select Task</label>
                <select id="help-task-select" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" required>
                    <option value="">Choose a task…</option>
                    @foreach($tasks as $t)
                        <option value="{{ $t['id'] }}">{{ $t['title'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Help Message</label>
                <textarea name="message" rows="4" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" placeholder="Explain how to approach or fix the task"></textarea>
            </div>

            <button class="w-full rounded-2xl bg-sky-600 px-4 py-2 font-medium text-white shadow hover:bg-sky-700">Send Help</button>
        </form>


        @php
            $helps = [
                ['task' => 'History Essay', 'message' => 'Focus on primary sources and use MLA style.'],
                ['task' => 'Math Homework', 'message' => 'Try breaking problems into smaller steps.'],
            ];
        @endphp

        <div class="mt-6">
            <h3 class="font-semibold mb-2">Help Messages ({{ count($helps) }})</h3>
            <ul class="space-y-2">
                @foreach($helps as $h)
                    <li class="border rounded-lg p-2">
                        <span class="font-medium">{{ $h['task'] }}:</span>
                        <span class="text-gray-600">{{ $h['message'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- Tiny script to switch form action dynamically --}}
<script>
const reviewSelect = document.getElementById('review-task-select');
const reviewForm = document.getElementById('review-form');
if (reviewSelect && reviewForm) {
    reviewSelect.addEventListener('change', (e) => {
        reviewForm.action = e.target.value || reviewForm.action;
    });
}

const helpSelect = document.getElementById('help-task-select');
const helpForm = document.getElementById('help-form');
if (helpSelect && helpForm) {
    helpSelect.addEventListener('change', (e) => {
        helpForm.action = e.target.value || helpForm.action;
    });
}
</script>
@endsection
