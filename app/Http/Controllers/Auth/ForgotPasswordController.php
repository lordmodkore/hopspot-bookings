<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return inertia('Auth/ForgotPassword'); // Assuming you're using Inertia.js with a Vue component
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $request->validate(['email' => 'required|email']);

        // Use the Password facade to send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the response status and redirect to login with a success message
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->back()->with('flash', ['success' => __('A password reset link has been sent to your email.')]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
