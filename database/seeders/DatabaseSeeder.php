<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'nama_user' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'is_confirmed' => true,
            'alamat' => 'Jl. Jalan',
            'no_hp' => '081234567890',
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'nama_user' => 'reseller',
            'email' => 'reseller@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'is_confirmed' => true,
            'alamat' => 'Jl. Besamamu',
            'no_hp' => '081234567890',
            'role' => 'reseller',
        ]);
    }
}
