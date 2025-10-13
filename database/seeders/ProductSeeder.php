<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $imageDir = public_path('storage/products');

        // ✅ 1. Cek apakah folder lokal ada
        if (!is_dir($imageDir)) {
            $this->command->warn("⚠️ Folder {$imageDir} tidak ditemukan. Skip seeding dari folder lokal.");

            // ✅ 2. Kalau folder gak ada, tapi kita mau isi data dasar supaya gak error
            // Misal ambil data dari kategori yang udah ada (supaya gak kosong total)
            $defaultCategory = Category::first();

            if ($defaultCategory) {
                Product::firstOrCreate([
                    'name' => 'Sample Product Cloud',
                ], [
                    'id' => (string) Str::uuid(),
                    'category_id' => $defaultCategory->id,
                    'description' => 'Produk contoh dari Cloudinary (tanpa gambar lokal)',
                    'price' => 999999,
                    'stock' => 10,
                    'sku' => strtoupper(Str::random(8)),
                    'weight' => 0.5,
                    'image' => 'https://res.cloudinary.com/YOUR_CLOUD_NAME/image/upload/v1/default.jpg',
                    'hub_product_id' => null,
                    'is_active' => true,
                    'is_visible' => true,
                ]);
            }

            return; // 🚪 keluar dari seeder supaya gak lanjut ke scandir()
        }

        // ✅ 3. Kalau folder ada, lanjut pakai logic lama
        $files = scandir($imageDir);

        foreach ($files as $file) {
            if (!in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
                continue;
            }

            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $brand = ucfirst(strtok($fileName, ' ')); // ambil kata pertama sebagai kategori

            $category = Category::where('name', $brand)->first();
            if (!$category) continue;

            Product::updateOrCreate([
                'name' => $fileName,
            ], [
                'id' => (string) Str::uuid(),
                'category_id' => $category->id,
                'description' => 'Produk ' . $fileName,
                'price' => rand(500000, 2500000),
                'stock' => rand(5, 25),
                'sku' => strtoupper(Str::random(8)),
                'weight' => rand(200, 1200) / 10, // gram
                'image' => 'products/' . $file,
                'hub_product_id' => null,
                'is_active' => true,
                'is_visible' => true,
            ]);
        }
    }
}
