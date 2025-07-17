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
            'Canon' => 'Kamera Canon',
            'Fujifilm' => 'Kamera Fujifilm',
            'Nikon' => 'Kamera Nikon',
            'Olympus' => 'Kamera Olympus',
            'Samsung' => 'Kamera Samsung',
            'Sony' => 'Kamera Sony',
        ];

        foreach ($brands as $name => $desc) {
            Category::updateOrCreate([
                'name' => $name,
            ], [
                'id' => (string) Str::uuid(),
                'description' => $desc,
                'hub_category_id' => null,
                'is_active' => true,
                'is_visible' => true,
            ]);
        }
    }
}
