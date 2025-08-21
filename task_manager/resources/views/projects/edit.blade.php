@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

    <form method="POST" action="{{ route('projects.update',$project) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ $project->title }}" class="w-full border p-2 rounded" required>
            @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border p-2 rounded">{{ $project->description }}</textarea>
        </div>

        <button class="px-4 py-2 bg-yellow-600 text-white rounded">Update</button>
        <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</a>
    </form>
</div>
@endsection
