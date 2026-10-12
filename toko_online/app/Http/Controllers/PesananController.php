<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Order::where('id_user', Auth::id())
            ->orderByDesc('tanggal_order')
            ->get();

        return view('pesanan.index', compact('pesanan'));
    }

    public function show(string $id)
    {
        $pesanan = Order::with('details.product')
            ->where('id_user', Auth::id())
            ->where('id_order', $id)
            ->firstOrFail();

        return view('pesanan.show', compact('pesanan'));
    }
}