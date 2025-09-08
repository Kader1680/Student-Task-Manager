@extends('layouts.master')

@section('content')
<div class="max-w-5xl mx-auto mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Help Students</h1>

    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Task ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Task</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Response</th>

                    

                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Response</th>

                 </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($helps as $help)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800 font-semibold">#{{ $help['task_id'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $help->tasks->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $help->content }}</td>
                         <td class="px-6 py-4 text-sm text-gray-600">
                        @if( $help->response === null)
                            <div class="flex justify-between">
                                <span class="text-red-500 font-semibold">Not Answer</span>
                                <a href="{{ route("helps-teacher.reply.form", $help->id) }}"><i class="fa-solid fa-message fs-4"></i> Repley </a>
                            </div>

                        @else
                            <span class="text-green-500 font-semibold">{{ $help->response }}</span>
                        @endif
                        </td>
                     </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
