<?php

use App\Exceptions\ResponseException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HasRoleMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'hasRole' => HasRoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $t) {

            // dd($t instanceof Illuminate\Auth\AuthenticationException);

            // Using instanceof (Recommended)
            $code = match (true) {
                $t instanceof  Illuminate\Auth\AuthenticationException,
                $t instanceof  Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException => 401,
                $t instanceof  Illuminate\Auth\Access\AuthorizationException => 403,
                $t instanceof  Illuminate\Database\Eloquent\ModelNotFoundException => 404,
                $t instanceof  Illuminate\Validation\ValidationException => 422,
                default => 500,
            };

            // Using get_class()

            // $code = match (get_class($t)) {
            //     Illuminate\Auth\AuthenticationException::class,
            //     Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class => 401,
            //     Illuminate\Auth\Access\AuthorizationException::class => 403,
            //     Illuminate\Database\Eloquent\ModelNotFoundException::class => 404,
            //     Illuminate\Validation\ValidationException::class => 422,
            //     default => 500,
            // };

            // $message = $t->getMessage();
            // if ($code === 500)  $message = 'Internal Server Error';

            // OR
            $message = $code === 500 ? 'Internal Server Error' : $t->getMessage();

            throw new ResponseException($message, $code);
        });
    })->create();
