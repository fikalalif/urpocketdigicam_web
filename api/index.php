<?php

// Paksa untuk membersihkan cache konfigurasi
// Ini adalah langkah "brute force" untuk memastikan konfigurasi baru dibaca
if (isset($_ENV['VERCEL'])) {
    // Hapus file cache konfigurasi jika ada
    if (file_exists(__DIR__ . '/../bootstrap/cache/config.php')) {
        unlink(__DIR__ . '/../bootstrap/cache/config.php');
    }
}

require __DIR__ . '/../public/index.php';
