<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
         then: function ($router) {
            Route::prefix('core')
                ->group(function () {
                    Route::
                    prefix('/api')
                    ->group(base_path('routes/auth/auth.php'));
                    
                    Route::group([
                        'middleware' => 'auth:sanctum',
                        'prefix' => '/api'
                    ], function ($router) {
                        $routes = glob(base_path('routes/*/*.php'));
                        foreach ($routes as $route) {
                            $folder = basename(dirname($route));
                            if ($folder !== 'auth') {
                                require $route;
                            }
                        }
                    });

                });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
