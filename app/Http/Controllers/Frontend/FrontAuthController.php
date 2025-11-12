<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class FrontAuthController extends Controller
{
    public function loginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('web')->attempt(array_merge($request->only('email', 'password'), ['role' => 'user', 'status' => 'active']))) {
            return redirect()->route('frontend.home')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    /**
     * Show registration page
     */
    public function registerForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // requires password_confirmation field
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'status'  => 'active'
        ]);

        Auth::guard('web')->login($user); // log in the newly registered user
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
