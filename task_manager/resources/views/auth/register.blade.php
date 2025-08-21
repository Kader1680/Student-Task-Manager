@extends('layouts.master')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Register</h2>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Name"
            class="w-full p-2 border rounded" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full p-2 border rounded" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full p-2 border rounded" required>

        <input type="password" name="password_confirmation" placeholder="Confirm Password"
            class="w-full p-2 border rounded" required>

        <button class="w-full bg-green-600 text-white p-2 rounded">Register</button>
    </form>
</div>
@endsection
