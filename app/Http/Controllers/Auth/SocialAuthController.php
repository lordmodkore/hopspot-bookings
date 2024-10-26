<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class SocialAuthController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        return $this->createUser($user);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find or create a user
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create a new user if not found
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(uniqid()), // Use a random password for social login
                ]);
            }

            // Log the user in
            Auth::login($user);
            // Redirect to the desired Inertia page
            return redirect()->intended('/')->with('flash',  ['success' => 'Login successful!']);

        } catch (\Exception $e) {
            return redirect()->route('login')->with('flash',  ['error' => 'Could not login with Google!']);
        }
    }

    /**
     * @param $socialUser
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createUser($socialUser)
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(str_random(16)), // Create a random password
            ]);
        }

        Auth::login($user, true);
        return redirect()->intended('/')->with('success', 'You are logged in!');
    }
}
