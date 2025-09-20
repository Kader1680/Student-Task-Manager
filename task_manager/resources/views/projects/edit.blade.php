@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 shadow-lg rounded-2xl border border-gray-100">
    <h1 class="text-2xl font-bold text-gray-800 mb-6"> Edit Project</h1>

    <form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-600">Title</label>
            <input
                type="text"
                name="title"
                value="{{ $project->title }}"
                class="w-full border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 p-3 rounded-lg text-gray-800"
                required>
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-600">Description</label>
            <textarea
                name="description"
                rows="4"
                class="w-full border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 p-3 rounded-lg text-gray-800">{{ $project->description }}</textarea>
        </div>

        {{-- Deadline field --}}
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-600">Deadline</label>
            <input
                type="datetime-local"
                name="deadline"
                value="{{ $project->deadline ? $project->deadline->format('Y-m-d\TH:i') : '' }}"
                class="w-full border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 p-3 rounded-lg text-gray-800">
            @error('deadline')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow">
                Update
            </button>
            <a href="{{ route('projects.index') }}"
               class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg shadow">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
