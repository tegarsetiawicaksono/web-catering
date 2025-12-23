<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If user is admin and trying to access non-profile/non-order routes, redirect to admin dashboard
        // Allow admin to access their own profile and order history
        if (Auth::user()->is_admin && !$request->routeIs('profile.*') && !$request->routeIs('orders.*')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
