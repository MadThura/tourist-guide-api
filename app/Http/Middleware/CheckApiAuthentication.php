<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*') && auth('sanctum')->guest()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to access this resource.',
                'status' => 401,
            ], 401);
        }
        return $next($request);
    }
}
