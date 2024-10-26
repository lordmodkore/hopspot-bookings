<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Log;

class LoginController extends Controller
{
    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        return redirect()->route('login')->with('flash', [
            'success' => 'You have logged in successfully!',
            'error' => 'Login failed. Please try again.',
        ]);


    }
    public function logout(Request $request)
    {
        Auth::logout();  // Log the user out

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the CSRF token for security

        return Inertia::location(route('login'));  // Redirect to login page
    }

    public function showLoginForm()
    {
        return Inertia::render('Auth/LoginForm', [
            'logoUrl' => asset('images/logo-dark.png'),
            'googleIconUrl' => asset('images/svgs/google-icon.svg'),
            'facebookIconUrl' => asset('images/svgs/facebook-icon.svg'),
        ]);
    }
}
