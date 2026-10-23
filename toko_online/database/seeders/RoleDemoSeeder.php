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
            ['username' => 'admin1', 'nama_lengkap' => 'Admin Utama', 'role' => 'admin'],
            ['username' => 'customer1', 'nama_lengkap' => 'Customer Satu', 'role' => 'customer'],
            ['username' => 'customer2', 'nama_lengkap' => 'Customer Dua', 'role' => 'customer'],
            ['username' => 'staff1', 'nama_lengkap' => 'Staff Satu', 'role' => 'staff'],
        ];

        foreach ($accounts as $a) {
            $user = User::firstOrNew(['username' => $a['username']]);
            // forceFill dipakai karena role sengaja TIDAK ada di $fillable
            $user->forceFill([
                'nama_lengkap' => $a['nama_lengkap'],
                'role' => $a['role'],
                'password' => Hash::make('password123'),
            ])->save();
        }
    }
}