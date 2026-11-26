<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request and enforce security headers that protect
     * user sessions, cookies, and prevent clickjacking and MIME-sniffing.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Enforce clickjacking protection (prevents framing to steal sessions)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Prevent session tokens or internal URLs leaking in HTTP referrers
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Restrict sensitive browser features from being hijacked
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // If connection is secure / HTTPS, enforce HSTS
        if ($request->isSecure() || app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
