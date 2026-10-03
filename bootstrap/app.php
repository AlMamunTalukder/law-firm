<?php

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use App\Http\Middleware\PermissionMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('web')
                ->namespace('App\Http\Controllers')
                ->group(base_path('routes/web.php'));
        },
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'PDF' => Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::class,
            'DataTables' => Yajra\DataTables\Facades\DataTables::class,
            'Hijri' => Alkoumi\LaravelHijriDate\Hijri::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'has_permissions' => PermissionMiddleware::class,
            'Captcha' => 'Mews\Captcha\Facades\Captcha',
        ]);
        $middleware->validateCsrfTokens(except: [
            'search'
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
