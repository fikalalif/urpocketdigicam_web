<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class ViteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Vite::class, function () {
            $vite = new Vite(public_path('..') . '/api/public/build/manifest.json');
            return $vite->useBuildDirectory('api/public/build');
        });
    }
}
