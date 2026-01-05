<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated; // Middleware bawaan Laravel
use App\Http\Middleware\PreventAuthenticatedAccess;     // Middleware custom kamu (opsional)

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Alias untuk middleware bawaan Laravel (REKOMENDASI PAKAI INI)
        // Ini sudah ada di Laravel, namanya 'guest'
        $middleware->alias([
            'guest' => RedirectIfAuthenticated::class,
        ]);

        // 2. Kalau kamu mau pakai middleware custom sendiri
        // Uncomment baris di bawah kalau kamu sudah buat PreventAuthenticatedAccess
        // $middleware->alias([
        //     'guest.only' => PreventAuthenticatedAccess::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
