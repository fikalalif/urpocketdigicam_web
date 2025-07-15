<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Pastikan kategori sudah ada
        if ($categories->count() == 0) {
            $this->command->warn('Kategori belum ada. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        // Tambahkan produk ke tiap kategori
        foreach ($categories as $category) {
            Product::create([
                'name' => 'Contoh Produk ' . $category->name,
                'price' => rand(10000, 50000),
                'category_id' => $category->id,
            ]);
        }
    }
}
