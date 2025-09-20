@extends('layouts.master')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">

     <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold">Create Project for Student</h2>
        <form action="{{ route('teacher.store') }}" method="POST" class="space-y-4">
        @csrf



        <div>
            <label for="title" class="mb-1 block text-sm font-medium">Project Title</label>
            <input
                type="text"
                name="title"
                class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring"
                placeholder="Project title"
                required>
        </div>


 <div>
            <label for="description" class="mb-1 block text-sm font-medium">Description Title</label>
            <input
                type="textarea"
                name="description"
                class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring"
                placeholder="Project Description"
                required>
        </div>

        <div>
            <label for="deadline" class="mb-1 block text-sm font-medium">Deadline</label>
            <input
                type="datetime-local"
                name="deadline"
                id="deadline"
                class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring">
        </div>

        <button type="submit"
            class="w-full rounded-2xl bg-sky-600 px-4 py-2 font-medium text-white shadow hover:bg-sky-700">
            Create Project
        </button>
    </form>


        <div class="mt-6 space-y-6">
    <h3 class="text-xl font-bold text-gray-800">
        Created Projects ({{ $projects->count()  }})
    </h3>

    @foreach($projects as $p)
        <div class="bg-white shadow rounded-xl p-6 border border-gray-200">

            <h4 class="text-lg font-semibold text-black-700 mb-4">
              Project title :<span class="text-md font-semibold text-green-700"> {{ $p->title }}</span>
            </h4>

  <h4 class="text-lg font-semibold text-black-700 mb-4">
              Project Description :<span class="text-md font-semibold text-green-700"> {{ $p->description }}</span>
            </h4>
            <h4 class="text-lg font-semibold text-black-700 mb-4">
                Deadline :
                <span class="text-md font-semibold text-green-700" id="deadline-{{ $p->id }}">
                    {{ $p->deadline }}
                </span>
                <span class="text-md font-semibold text-blue-700" id="timeleft-{{ $p->id }}"></span>
            </h4>

<div>
<a class=" p-2 rounded-circle  bg-yellow-200" href="{{ route("project.download", $p->id) }}">Download <i class="fa-solid fa-file-pdf"></i></a>
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
        const deadline = document.getElementById("deadline-{{ $p->id ?? 1 }}").innerText;
        const result = timeLeft(deadline);
        document.getElementById("timeleft-{{ $p->id ?? 1  }}").innerText = ` (${result})`;
    });





</script>
@endsection
