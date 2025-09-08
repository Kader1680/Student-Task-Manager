@extends('layouts.master')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">

     <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold">Create Project for Student</h2>
        <form action="{{route("teacher.store")}}" method="POST" class="space-y-4">
            @csrf



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

        <div class="mt-6 space-y-6">
    <h3 class="text-xl font-bold text-gray-800">
        Created Projects ({{ $projects->count() }})
    </h3>

    @foreach($projects as $p)
        <div class="bg-white shadow rounded-xl p-6 border border-gray-200">

            <h4 class="text-lg font-semibold text-black-700 mb-4">
              Project title :<span class="text-md font-semibold text-green-700"> {{ $p->title }}</span>
            </h4>

            <!-- Students list -->
            <div>
                <h5 class="text-sm font-medium text-gray-600 mb-2">Students:</h5>
                @if($p->users)
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">
                            {{ $p->users->name }}
                        </span>
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">No students assigned</p>
                @endif
            </div>
        </div>
    @endforeach
</div>

    </div>


    {{-- Review Task --}}
    <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold">Add Review on Task</h2>
        <form action="{{route("teacher.dashboard")}}" method="POST" class="space-y-4"  >
            @csrf


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
                        <span class="font-medium"> {{ $r->tasks->title }} : </span>
                        <span class="text-gray-600">{{ $r['feedback'] }}</span>
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
