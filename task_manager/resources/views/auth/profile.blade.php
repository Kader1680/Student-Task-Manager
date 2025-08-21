@extends('layouts.master')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Profile</h2>
    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
</div>
@endsection
