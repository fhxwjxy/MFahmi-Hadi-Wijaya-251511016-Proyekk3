<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        $barang = Barang::whereIn('id', array_keys($keranjang))->get()->keyBy('id');

        $items = [];
        $total = 0;
        foreach ($keranjang as $id => $jumlah) {
            if (!isset($barang[$id])) {
                continue; // barang sudah tidak ada di database
            }
            $b = $barang[$id];
            $subtotal = $b->harga * $jumlah; // harga SELALU dari database
            $total += $subtotal;
            $items[] = ['barang' => $b, 'jumlah' => $jumlah, 'subtotal' => $subtotal];
        }

        return view('keranjang', compact('items', 'total'));
    }

    // Tambah 1. Jika barang sama dipilih lagi, jumlah bertambah.
    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = session('keranjang', []);

        $jumlahBaru = ($keranjang[$id] ?? 0) + 1;
        if ($jumlahBaru > $barang->stok) {
            return back()->with('error', 'Stok ' . $barang->nama . ' hanya ' . $barang->stok . '.');
        }

        $keranjang[$id] = $jumlahBaru;
        session(['keranjang' => $keranjang]);

        return back()->with('sukses', $barang->nama . ' dimasukkan ke keranjang.');
    }

    // Kurang 1. Jika jumlah menjadi 0, item dihapus otomatis.
    public function kurang($id)
    {
        $keranjang = session('keranjang', []);
        if (isset($keranjang[$id])) {
            $keranjang[$id]--;
            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
            session(['keranjang' => $keranjang]);
        }
        return back();
    }

    public function hapus($id)
    {
        $keranjang = session('keranjang', []);
        unset($keranjang[$id]);
        session(['keranjang' => $keranjang]);
        return back()->with('sukses', 'Item dihapus.');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return back()->with('sukses', 'Keranjang dikosongkan.');
    }
}