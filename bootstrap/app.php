<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // 'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {

        //for 405 errors
        $exceptions->renderable(function (MethodNotAllowedHttpException $e) {
            return response()->json([
                'error' => 'Not true Request Type',
            ], 405);
        });
        //for 404 errors
        $exceptions->renderable(function (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User or Record Not Found',
            ], 404);
        });

        //  //general error
        //  $exceptions->renderable(function(Throwable $e){
        //     return response()->json([
        //         'error'=>'Some thing  went Wrong'
        //     ],500);
        //  });

    })->create();