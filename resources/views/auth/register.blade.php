@extends('layouts.master')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-blue-800">Create Account</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in your details to register</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@example.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Register As</label>
                <select name="role" id="role"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2.5 rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Register
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            <p>Already have an account? 
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Sign In</a>
            </p>
        </div>
    </div>
</div>
@endsection
