<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        $middleware->redirectTo(
            guests: '/SuperadminMusashi/login',
            users: '/SuperadminMusashi'
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (env('APP_STORAGE')) {
    $app->useStoragePath(env('APP_STORAGE'));
}

return $app;
