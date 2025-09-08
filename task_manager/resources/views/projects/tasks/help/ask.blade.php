@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Ask for Help on a Task</h2>
 
    <form action="{{ route("tasks.ask.store", $task->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium">
                Task: {{ $task->title }}
            </label>

        </div>



        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-medium">What do you need help with?</label>
            <textarea name="content" id="content" rows="3"
                      class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                      placeholder="Explain your problem or what you don’t understand..."></textarea>
        </div>
 

<div class="mb-4">
    <label for="teacher_id" class="block text-gray-700 font-medium">Choose Teacher</label>
    <select name="teacher_id" id="teacher_id"
            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        <option value="">-- Select Teacher --</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>
</div>




        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-green-500 text-white p-2 rounded-lg hover:bg-green-600">
                Request Help
            </button>
        </div>
    </form>
</div>
@endsection
