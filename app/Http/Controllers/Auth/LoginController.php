<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed, redirect to dashboard or home page
            return redirect()->intended('/')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();  // Log the user out

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the CSRF token for security

        return Inertia::location(route('login'));  // Redirect to login page
    }
    public function show()
    {
        return Inertia::render('Auth/LoginForm', [
            'logoUrl' => asset('images/logo-dark.png'),
            'googleIconUrl' => asset('images/svgs/google-icon.svg'),
            'facebookIconUrl' => asset('images/svgs/facebook-icon.svg'),
        ]);
    }
}
