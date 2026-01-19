<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/dashboard.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'permission' => \App\Http\Middleware\CheckPermission::class,
        ]);

        // Add redirect middleware to web group
        $middleware->web(append: [
            \App\Http\Middleware\HandleRedirects::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom error pages
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->is('admin/*')) {
                return response()->view('errors.404', [], 404);
            }
            return response()->view('errors.404', [], 404);
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            return response()->view('errors.403', [], 403);
        });

        $exceptions->render(function (\Throwable $e, $request) {
            if (app()->environment('production') && !$request->is('admin/*')) {
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    $statusCode = $e->getStatusCode();
                    if (view()->exists("errors.{$statusCode}")) {
                        return response()->view("errors.{$statusCode}", [], $statusCode);
                    }
                }

                // For any other server errors in production
                if (!($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException)) {
                    return response()->view('errors.500', [], 500);
                }
            }

            return null; // Let Laravel handle it normally
        });
    })->create();
