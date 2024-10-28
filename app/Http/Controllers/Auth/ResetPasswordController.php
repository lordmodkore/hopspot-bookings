<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ResetPasswordController extends Controller
{


    /**
     * Show the form for resetting the password.
     *
     * @param Request $request
     * @param string|null $token
     * @return \Inertia\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        // Attempt to reset the user's password
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        // Check the response status and return accordingly
        if ($response === Password::PASSWORD_RESET) {
            // Set flash message to prompt the user to log in
            return redirect()->route('login')->with('flash',['success' => 'Your password has been reset. You can now log in with your new password.']);
        }

        return back()->withErrors(['email' => trans($response)]);
    }
}
