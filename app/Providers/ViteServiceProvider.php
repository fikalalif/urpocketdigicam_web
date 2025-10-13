<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Vite;

class ViteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend('vite', function () {
            // Deteksi environment di Vercel
            $manifestPath = base_path('api/public/build/manifest.json');

            // Kalau file manifest ada di lokasi baru, pakai itu
            if (file_exists($manifestPath)) {
                return new Vite('/api/public/build', $manifestPath);
            }

            // Default fallback untuk lokal
            return new Vite('public/build', public_path('build/manifest.json'));
        });
    }
}
