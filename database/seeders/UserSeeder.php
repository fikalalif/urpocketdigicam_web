<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Kondisi pengecekan unik
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
