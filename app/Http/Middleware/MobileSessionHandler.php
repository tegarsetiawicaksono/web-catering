<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MobileSessionHandler
{
    public function handle(Request $request, Closure $next)
    {
        // Detect if request is from mobile
        $userAgent = $request->header('User-Agent');
        $isMobile = preg_match('/(android|iphone|ipad|mobile)/i', strtolower($userAgent));

        if ($isMobile) {
            // Ensure session configuration is mobile-friendly
            config([
                'session.same_site' => 'lax',
                'session.secure' => false,
                'session.http_only' => true
            ]);

            // Force regenerate session ID for mobile requests
            if (!$request->session()->has('mobile_session')) {
                $request->session()->put('mobile_session', true);
                $request->session()->regenerate();
            }
        }

        return $next($request);
    }
}