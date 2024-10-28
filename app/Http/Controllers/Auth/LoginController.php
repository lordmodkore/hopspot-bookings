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
            'remember_me' => 'boolean',
        ]);

        $remember = $request->input('remember_me', false);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home')->with('flash', ['success' => 'Logged In successfully!']);
        }

        return redirect()->route('login')->with('flash', ['error' => 'Invalid credentials!']);
    }
    public function logout(Request $request)
    {
        Auth::logout();  // Log the user out

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the CSRF token for security

        return redirect()->route('login')->with('flash', ['success' => 'Logged out successfully!']);

    }

    public function showLoginForm(Request $request)
    {
        return Inertia::render('Auth/LoginForm', [
            'logoUrl' => asset('images/logo-dark.png'),
            'googleIconUrl' => asset('images/svgs/google-icon.svg'),
            'facebookIconUrl' => asset('images/svgs/facebook-icon.svg'),
        ]);
    }
}
