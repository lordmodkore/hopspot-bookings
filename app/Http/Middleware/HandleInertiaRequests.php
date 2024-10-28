<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Log;
use Closure;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle(Request $request, Closure $next)
//    {
//        // Log request information
//        Log::info('======== Request info ===============');
//        Log::info('Request Method:', [$request->method()]);
//        Log::info('Request URL:', [$request->fullUrl()]);
//        Log::info('Flash data:', $request->session()->all());
//
//        // Log which middleware is running
//        Log::info('Middleware running:', [self::class]);
//
//        Log::info('==========================');
//
//        return $next($request);
//    }
    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Log request information
        Log::info('======== Request info ===============');
        Log::info('Request Method:', [$request->method()]);
        Log::info('Request URL:', [$request->fullUrl()]);
        Log::info('Flash data:', $request->session()->all());

        return array_merge(parent::share($request), [
            'flash' => [
                'success' => fn () => $request->session()->pull('flash.success'),  // Using pull to retrieve and clear in one go
                'error' => fn () => $request->session()->pull('flash.error'),      // Same here for error flash
            ],
            'errors' => fn () => $request->session()->get('errors') ? $request->session()->get('errors')->getBag('default')->getMessages() : [],
        ]);
    }

}
