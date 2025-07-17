<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                Product::create([
                    'id' => (string) Str::uuid(),
                    'name' => $category->name . ' Model ' . $i,
                    'description' => 'Deskripsi produk ' . $category->name . ' Model ' . $i,
                    'price' => rand(1000000, 50000000),
                    'stock' => rand(5, 20),
                    'sku' => strtoupper(substr($category->name, 0, 3)) . '-' . rand(1000, 9999),
                    'image_url' => 'https://via.placeholder.com/300?text=' . urlencode($category->name . ' ' . $i),
                    'weight' => rand(500, 3000),
                    'is_active' => true,
                    'is_visible' => true,
                    'hub_product_id' => null,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
