<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Log;

class LoginController extends Controller
{
    public function processLogin(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'remember_me' => 'boolean',
            ]);
        } catch (ValidationException $e) {
            // Capture validation errors and redirect back with errors as flash data
            return redirect()->back()->withErrors($e->errors())->withInput()->with('flash', ['error' => 'Please fix the errors and try again.']);
        }

        // Retrieve input and set remember me
        $remember = $request->input('remember_me', false);
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed
            return redirect()->route('home')->with('flash', ['success' => 'Logged in successfully!']);
        }

        $request->session()->flash('flash.error', 'Invalid credentials!');
        Log::info('Flash message set in login controller:', ['flash' => $request->session()->get('flash')]);

        // If login attempt failed
        return redirect()->back()->withInput() // Retain input data
                         ->withErrors(['email' => 'Invalid credentials!'])
                         ->with('flash.error', 'Invalid credentials!');
    }
    public function logout(Request $request)
    {
        Auth::logout();  // Log the user out

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the CSRF token for security

        return redirect()->route('login')->with('flash', ['success' => 'Logout Successfully!']);

    }

    public function showLoginForm(Request $request)
    {
        return Inertia::render('Auth/LoginForm', [
            'logoUrl' => asset('images/logo-dark.png'),
            'googleIconUrl' => asset('images/svgs/google-icon.svg'),
            'facebookIconUrl' => asset('images/svgs/facebook-icon.svg')
        ]);
    }
}
