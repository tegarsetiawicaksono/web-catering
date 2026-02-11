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

        // Redirect admin to admin dashboard (but allow them to access profile and orders)
        if (Auth::user()->is_admin) {
            // Allow admin to access profile and order routes
            if ($request->routeIs('profile.*') || $request->routeIs('orders.*')) {
                return $next($request);
            }
            // Redirect to admin dashboard for other user routes
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
