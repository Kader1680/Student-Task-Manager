@extends('layouts.master')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-blue-800">Welcome Back</h2>
            <p class="text-sm text-gray-500 mt-1">Please sign in to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" placeholder="you@example.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2.5 rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            <p>Don’t have an account? 
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Sign Up</a>
            </p>
        </div>
    </div>
</div>
@endsection
