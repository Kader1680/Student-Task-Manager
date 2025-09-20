<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'    => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); 

        return redirect()->route('profile')->with('success', 'Registration successful! Welcome.');
    }

  
    public function showLogin()
    {
        return view('auth.login');
    }

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
