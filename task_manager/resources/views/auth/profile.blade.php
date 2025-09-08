@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto mt-12">
    <div class="bg-white rounded-2xl shadow-lg p-8 text-center border">
        <div class="flex justify-center mb-4">
            <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-600 shadow">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-1">
            {{ auth()->user()->name }}
        </h2>
        <p class="text-gray-500 mb-6">
            {{ auth()->user()->role }}
        </p>

        <div class="text-left space-y-3">
            <p class="flex justify-between border-b pb-2">
                <span class="font-semibold text-gray-700">Name:</span> 
                <span>{{ auth()->user()->name }}</span>
            </p>
            <p class="flex justify-between border-b pb-2">
                <span class="font-semibold text-gray-700">Email:</span> 
                <span>{{ auth()->user()->email }}</span>
            </p>
            <p class="flex justify-between">
                <span class="font-semibold text-gray-700">Role:</span> 
                <span class="capitalize">{{ auth()->user()->role }}</span>
            </p>
        </div>

         
    </div>
</div>
@endsection
