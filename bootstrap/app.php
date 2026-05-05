<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
        //
=======
<<<<<<< HEAD
        //
=======
<<<<<<< HEAD
<<<<<<< HEAD
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
            'staff' => \App\Http\Middleware\CheckStaff::class,
        ]);
=======
        //
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        //
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
