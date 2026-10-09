<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'budi',
            'nama_lengkap' => 'Budi Santoso',
            'password' => 'rahasia123',
        ]);

        User::create([
            'username' => 'siti',
            'nama_lengkap' => 'Siti Aminah',
            'password' => 'rahasia456',
        ]);
    }
}