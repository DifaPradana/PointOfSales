<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nama_user' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'status' => 'Aktif',
            'alamat' => 'Jl. Jalan',
            'no_hp' => '081234567890',
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'nama_user' => 'reseller',
            'email' => 'reseller@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'status' => 'Menunggu Konfirmasi',
            'alamat' => 'Jl. Besamamu',
            'no_hp' => '081234567890',
            'role' => 'reseller',
        ]);

        $brands = [
            'Nike',
            'Adidas',
            'Puma',
            'Reebok',
            'New Balance',
            'Asics',
            'Converse',
            'Vans',
            'Under Armour',
            'Sketchers',
            'Fila',
            'Crocs',
            'Birkenstock',
            'Havaianas',
            'Teva',
            'Clarks',
            'Timberland',
            'Dr. Martens',
            'Salomon',
            'Merrell'
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'nama_brand' => $brand,
            ]);
        }
    }
}
