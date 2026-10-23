<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function proses(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => ['required', 'string'],
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang masih kosong.');
        }

        try {
            $order = DB::transaction(function () use ($keranjang, $request) {
                $total = 0;
                $baris = [];

                foreach ($keranjang as $idBarang => $jumlah) {
                    $produk = Product::lockForUpdate()->find($idBarang);

                    if (!$produk) {
                        throw new \RuntimeException("Barang {$idBarang} tidak ditemukan.");
                    }

                    if ($produk->stok < $jumlah) {
                        throw new \RuntimeException(
                            "Stok {$produk->nama_barang} tidak mencukupi (tersisa {$produk->stok})."
                        );
                    }

                    $total += $produk->harga * $jumlah;
                    $baris[] = [$produk, $jumlah];
                }

                $order = Order::create([
                    'id_order' => $this->buatIdOrder(),
                    'id_user' => Auth::id(),
                    'tanggal_order' => now(),
                    'total_harga' => $total,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                ]);

                foreach ($baris as [$produk, $jumlah]) {
                    $order->details()->create([
                        'id_barang' => $produk->id_barang,
                        'harga_satuan' => $produk->harga,
                        'jumlah_beli' => $jumlah,
                    ]);

                    $produk->decrement('stok', $jumlah);
                }

                return $order;
            });
        } catch (\RuntimeException $e) {
            return redirect()->route('keranjang.index')->with('error', $e->getMessage());
        }

        session()->forget('keranjang');

        return redirect()
            ->route('pesanan.show', $order->id_order)
            ->with('sukses', 'Checkout berhasil. Pesanan Anda tercatat.');
    }

    private function buatIdOrder(): string
    {
        do {
            $id = 'ORD' . now()->format('Ymd') . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Order::where('id_order', $id)->exists());

        return $id;
    }
}