<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'id_barang' => 'BRG001',
                'nama_barang' => 'Buku Tulis',
                'deskripsi' => 'Buku tulis 38 lembar',
                'harga' => 5000,
                'stok' => 100,
                'gambar' => 'Buku tulis.jpg'
            ],

            [
                'id_barang' => 'BRG002',
                'nama_barang' => 'Pulpen',
                'deskripsi' => 'Pulpen tinta hitam',
                'harga' => 3000,
                'stok' => 80,
                'gambar' => 'Pulpen.jpg'
            ],

            [
                'id_barang' => 'BRG003',
                'nama_barang' => 'Penggaris',
                'deskripsi' => 'Penggaris plastik 30 cm',
                'harga' => 4000,
                'stok' => 60,
                'gambar' => 'Penggaris.jpg'
            ],

            [
                'id_barang' => 'BRG004',
                'nama_barang' => 'Pensil 2B',
                'deskripsi' => 'Pensil 2B untuk ujian',
                'harga' => 2500,
                'stok' => 120,
                'gambar' => 'Pensil 2B.jpg'
            ],

            [
                'id_barang' => 'BRG005',
                'nama_barang' => 'Penghapus',
                'deskripsi' => 'Penghapus karet putih',
                'harga' => 1500,
                'stok' => 90,
                'gambar' => 'Penghapus.jpg'
            ],

            [
                'id_barang' => 'BRG006',
                'nama_barang' => 'Rautan Pensil',
                'deskripsi' => 'Rautan pensil logam',
                'harga' => 3500,
                'stok' => 50,
                'gambar' => 'Rautan Pensil.jpg'
            ],

            [
                'id_barang' => 'BRG007',
                'nama_barang' => 'Spidol Hitam',
                'deskripsi' => 'Spidol papan tulis',
                'harga' => 7000,
                'stok' => 40,
                'gambar' =>
                    'Spidol.jpg'
            ],

            [
                'id_barang' => 'BRG008',
                'nama_barang' => 'Stabilo',
                'deskripsi' => 'Penanda teks',
                'harga' => 8500,
                'stok' => 30,
                'gambar' => 'stabilo.jpg'
            ],

            [
                'id_barang' => 'BRG009',
                'nama_barang' => 'Map Plastik',
                'deskripsi' => 'Map plastik berkancing',
                'harga' => 2000,
                'stok' => 75,
                'gambar' => 'map-plastik.jpg'
            ],

            [
                'id_barang' => 'BRG010',
                'nama_barang' => 'Buku Gambar A4',
                'deskripsi' => 'Buku gambar ukuran A4 (stok habis)',
                'harga' => 6500,
                'stok' => 0,
                'gambar' => 'buku-gambar.jpg'
            ],
        ]);
    }
}