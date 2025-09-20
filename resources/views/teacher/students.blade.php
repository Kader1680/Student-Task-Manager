@extends('layouts.master')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Students List</h2>

    <div class="bg-white shadow rounded-lg divide-y">
        @foreach ($students as $student)
            <a href="{{ route('students.tasks', $student->id) }}"
               class="block px-4 py-3 hover:bg-gray-50 flex justify-between">
                <span class="font-semibold">{{ $student->name }}</span>
                {{

                $student->projects->sum(fn($p) => $p->tasks->count())


                }} tasks


            </a>
        @endforeach
    </div>


</div>
@endsection


