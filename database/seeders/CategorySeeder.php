<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
        ['id' => (string) Str::uuid(), 'name' => 'Cannon'],
        ['id' => (string) Str::uuid(), 'name' => 'Nikon'],
        ['id' => (string) Str::uuid(), 'name' => 'Sony'],
        ['id' => (string) Str::uuid(), 'name' => 'Fujifilm'],
        ['id' => (string) Str::uuid(), 'name' => 'Panasonic'],
        ['id' => (string) Str::uuid(), 'name' => 'Olympus'],
        ['id' => (string) Str::uuid(), 'name' => 'GoPro']
    ]);
    }
}