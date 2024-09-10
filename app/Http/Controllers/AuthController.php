<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login form submission (example)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            return redirect()->route('products.index')->with('success', 'You are logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle user logout
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
