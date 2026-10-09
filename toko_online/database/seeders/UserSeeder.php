<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'USR001',
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'username' => 'budi',
            'password' => 'rahasia123',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 10, Bandung',
        ]);

        User::create([
            'id_user' => 'USR002',
            'nama_lengkap' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'username' => 'siti',
            'password' => 'rahasia456',
            'no_hp' => '081298765432',
            'alamat' => 'Jl. Dago No. 25, Bandung',
        ]);
    }
}