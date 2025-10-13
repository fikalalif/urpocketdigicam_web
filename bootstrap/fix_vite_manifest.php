<?php

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\File;

app()->extend('vite', function () {
    $defaultManifest = public_path('build/manifest.json');
    $vercelManifest = base_path('api/public/build/manifest.json');

    // Pilih yang tersedia
    $manifestPath = File::exists($defaultManifest)
        ? $defaultManifest
        : (File::exists($vercelManifest)
            ? $vercelManifest
            : null);

    if (!$manifestPath) {
        error_log('❌ Tidak ditemukan manifest.json di keduanya');
        throw new Exception("Vite manifest.json not found.");
    }

    error_log("✅ Vite manifest dipakai dari: {$manifestPath}");

    $manifestDir = str_contains($manifestPath, 'api/public')
        ? '/api/public/build'
        : '/build';

    return new Vite($manifestDir, $manifestPath);
});
