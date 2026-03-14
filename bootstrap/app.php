<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\securitylogic;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Middleware\MustChangePassword;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register your middleware alias
        $middleware->alias([
            'logic' => securitylogic::class,
            'member' => MemberMiddleware::class,
            'must_change_password' => MustChangePassword::class,
        ]);
        
        // Redirect guests to login page (use simple path)
        $middleware->redirectGuestsTo('/Login-Page');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Exception handling configuration
    })->create();
