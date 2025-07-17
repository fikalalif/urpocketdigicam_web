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
        $imageDir = public_path('storage/products'); // asumsi file gambar dipindahkan ke sini
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
