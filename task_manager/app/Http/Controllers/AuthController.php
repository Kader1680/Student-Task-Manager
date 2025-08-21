<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'in:student,teacher'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'teacher',
        ]);

        Auth::login($user); // auto login after register

        return redirect()->route('auth.profile')->with('success', 'Registration successful! Welcome.');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('profile')->with('success', 'You are logged in!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    // Logout

public function logout(Request $request)
{

Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();



    return redirect()->route('login')->with('success', 'You have been logged out.');
}


    public function profile()
    {
        return view('auth.profile');
    }
}
