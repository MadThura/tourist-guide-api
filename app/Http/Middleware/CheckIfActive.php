<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // For web routes
        if (!request()->is('api/*')) {
            if (Auth::check() && !Auth::user()->is_active) {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Your account has been suspended by a superadmin.',
                ]);
            }
        }

        // For API routes
        if (request()->is('api/*') && !$request->user('sanctum')->is_active) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Your account has been suspended.'
            ], 403);
        }

        return $next($request);
    }
}
