@extends('layouts.app')

@section('judul', 'Detail Pesanan')

@section('isi')
    <h1>Detail Pesanan {{ $pesanan->id_order }}</h1>

    <p>Tanggal: {{ $pesanan->tanggal_order->format('d-m-Y H:i') }}</p>
    <p>Alamat pengiriman: {{ $pesanan->alamat_pengiriman }}</p>

    <table>
        <tr>
            <th>Barang</th>
            <th>Harga satuan (saat dibeli)</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($pesanan->details as $d)
            <tr>
                <td>{{ $d->product->nama_barang }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $d->jumlah_beli }}</td>
                <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Total bayar</strong></td>
            <td><strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <a class="btn" href="{{ route('pesanan.index') }}">Kembali ke riwayat</a>
@endsection