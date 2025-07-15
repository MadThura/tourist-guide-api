<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckApiAuthentication;
use App\Http\Middleware\CheckIfActive;
use App\Http\Middleware\EnsuerUser;
use App\Http\Middleware\EnsureEmailIsVerifiedAPI;
use App\Http\Middleware\ModeratorMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'active' => CheckIfActive::class,
            'checkapiauth' => CheckApiAuthentication::class,
            'isUser' => EnsuerUser::class,
            'verified.api' => EnsureEmailIsVerifiedAPI::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (NotFoundHttpException | ModelNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Resource not found.'
                ], 404);
            }

            // Let Laravel handle it by falling back to default 404 error view
            return null;
        });

        // Optional: catch all other exceptions
        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }

            return null; // fallback to Laravel default error handling
        });
    })->create();
