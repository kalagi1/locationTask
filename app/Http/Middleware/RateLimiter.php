<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $limit = 50;
        $decaySeconds = 60;

        $key = $request->ip();

        if (FacadesRateLimiter::tooManyAttempts($key, $limit)) {
            // Sınırları aşan bir durum
            return response()->json(['message' => 'Too many attempts. Try again later.'], 429);
        }

        FacadesRateLimiter::hit($key, $decaySeconds);

        // İstenilen eylemi gerçekleştir
        return $next($request);
    }
}
