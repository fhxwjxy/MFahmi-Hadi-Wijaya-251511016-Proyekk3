<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'id_user' => 'USR0001',
                'username' => 'admin1',
                'nama_lengkap' => 'Admin Utama',
                'email' => 'admin1@example.com',
                'role' => 'admin',
            ],
            [
                'id_user' => 'USR0002',
                'username' => 'customer1',
                'nama_lengkap' => 'Customer Satu',
                'email' => 'customer1@example.com',
                'role' => 'customer',
            ],
            [
                'id_user' => 'USR0003',
                'username' => 'customer2',
                'nama_lengkap' => 'Customer Dua',
                'email' => 'customer2@example.com',
                'role' => 'customer',
            ],
            [
                'id_user' => 'USR0004',
                'username' => 'staff1',
                'nama_lengkap' => 'Staff Satu',
                'email' => 'staff1@example.com',
                'role' => 'staff',
            ],
        ];

        foreach ($accounts as $a) {
            $user = User::firstOrNew([
                'username' => $a['username'],
            ]);

            $user->forceFill([
                'id_user' => $a['id_user'],
                'nama_lengkap' => $a['nama_lengkap'],
                'email' => $a['email'],
                'role' => $a['role'],
                'password' => Hash::make('password123'),
            ])->save();
        }
    }
}