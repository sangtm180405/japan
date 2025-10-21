<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $key = 'default', int $maxAttempts = 60, int $decayMinutes = 1): Response
    {
        $identifier = $this->resolveRequestSignature($request);
        
        if (RateLimiter::tooManyAttempts($identifier, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($identifier);
            
            return response()->json([
                'error' => 'Too many requests',
                'retry_after' => $seconds,
                'message' => 'Please try again in ' . $seconds . ' seconds'
            ], 429);
        }

        RateLimiter::hit($identifier, $decayMinutes * 60);

        $response = $next($request);

        return $this->addRateLimitHeaders($response, $identifier, $maxAttempts);
    }

    /**
     * Resolve request signature for rate limiting
     */
    protected function resolveRequestSignature(Request $request): string
    {
        $key = $request->route()?->getName() ?? 'default';
        $user = $request->user();
        $ip = $request->ip();
        
        if ($user) {
            return "rate_limit:{$key}:user:{$user->id}";
        }
        
        return "rate_limit:{$key}:ip:{$ip}";
    }

    /**
     * Add rate limit headers to response
     */
    protected function addRateLimitHeaders(Response $response, string $identifier, int $maxAttempts): Response
    {
        $remaining = RateLimiter::remaining($identifier, $maxAttempts);
        $retryAfter = RateLimiter::availableIn($identifier);
        
        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', max(0, $remaining));
        $response->headers->set('X-RateLimit-Reset', time() + $retryAfter);
        
        return $response;
    }
}