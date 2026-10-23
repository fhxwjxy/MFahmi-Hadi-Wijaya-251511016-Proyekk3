<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    private function ambil(): array
    {
        return session('keranjang', []);
    }

    private function simpan(array $keranjang): void
    {
        session(['keranjang' => $keranjang]);
    }

    public function index()
    {
        $items = [];
        $total = 0;

        foreach ($this->ambil() as $idBarang => $jumlah) {
            $produk = Product::find($idBarang);

            if (!$produk) {
                continue;
            }

            $subtotal = $produk->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'produk' => $produk,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('keranjang.index', compact('items', 'total'));
    }

    public function tambah(string $id)
    {
        $produk = Product::findOrFail($id);
        $keranjang = $this->ambil();
        $jumlahBaru = ($keranjang[$id] ?? 0) + 1;

        if ($produk->stok < 1) {
            return back()->with('error', "Stok {$produk->nama_barang} habis.");
        }

        if ($jumlahBaru > $produk->stok) {
            return back()->with('error', "Jumlah {$produk->nama_barang} melebihi stok (tersedia {$produk->stok}).");
        }

        $keranjang[$id] = $jumlahBaru;
        $this->simpan($keranjang);

        return back()->with('sukses', "{$produk->nama_barang} dimasukkan ke keranjang.");
    }

    public function ubah(Request $request, string $id)
    {
        $request->validate([
            'aksi' => ['required', 'in:tambah,kurang'],
        ]);

        $keranjang = $this->ambil();

        if (!isset($keranjang[$id])) {
            return redirect()->route('keranjang.index');
        }

        $produk = Product::findOrFail($id);

        if ($request->aksi === 'tambah') {
            if ($keranjang[$id] + 1 > $produk->stok) {
                return back()->with('error', "Jumlah {$produk->nama_barang} melebihi stok (tersedia {$produk->stok}).");
            }
            $keranjang[$id]++;
        } else {
            $keranjang[$id]--;
            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
        }

        $this->simpan($keranjang);

        return redirect()->route('keranjang.index');
    }

    public function hapus(string $id)
    {
        $keranjang = $this->ambil();
        unset($keranjang[$id]);
        $this->simpan($keranjang);

        return redirect()->route('keranjang.index')->with('sukses', 'Barang dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');

        return redirect()->route('keranjang.index')->with('sukses', 'Keranjang dikosongkan.');
    }
}