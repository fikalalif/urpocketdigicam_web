<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Langkah 1: Buat aplikasi seperti biasa
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// Langkah 2: Jika berjalan di Vercel...
if (isset($_ENV['VERCEL'])) {
    // Tentukan path sementara
    $bootstrapPath = '/tmp/bootstrap';
    $storagePath = '/tmp/storage';

    // ...DAN BUAT DIREKTORI YANG DIBUTUHKAN JIKA BELUM ADA
    // Ini adalah bagian yang paling penting
    $directories = [
        $bootstrapPath . '/cache',
        $storagePath . '/app/public',
        $storagePath . '/framework/cache/data',
        $storagePath . '/framework/sessions',
        $storagePath . '/framework/views',
        $storagePath . '/logs',
    ];

    foreach ($directories as $directory) {
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    // Arahkan Laravel untuk menggunakan path yang sudah kita siapkan
    $app->useBootstrapPath($bootstrapPath);
    $app->useStoragePath($storagePath);
}

// Langkah 3: Kembalikan aplikasi yang sudah siap
return $app;
