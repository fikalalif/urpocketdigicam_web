<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Canon',
            'Nikon',
            'Sony',
            'Fujifilm',
            'Panasonic',
            'Olympus',
            'Leica',
            'Pentax',
            'GoPro',
            'DJI',
        ];

        foreach ($brands as $brand) {
            Category::create([
                'id' => (string) Str::uuid(),
                'name' => $brand,
                'description' => 'Produk dari merk ' . $brand,
                'hub_category_id' => null,
            ]);
        }
    }
}
