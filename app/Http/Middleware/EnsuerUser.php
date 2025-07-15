<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsuerUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('sanctum');
        if (!$user || $user->role !== 'user') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Forbidden: You are not allowed to access this route.'
            ], 403);
        }

        return $next($request);
    }
}
