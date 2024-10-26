<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return Inertia::location(route('home'));  // Redirect to the dashboard or another protected page
        }

        return $next($request);
    }

}
