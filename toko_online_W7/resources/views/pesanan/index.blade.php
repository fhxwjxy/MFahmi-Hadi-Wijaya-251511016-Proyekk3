@extends('layouts.app')

@section('judul', 'Riwayat Pesanan')

@section('isi')
    <h1>Riwayat Pesanan</h1>

    @if ($pesanan->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
        <table>
            <tr>
                <th>ID Pesanan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
            @foreach ($pesanan as $o)
                <tr>
                    <td>{{ $o->id_order }}</td>
                    <td>{{ $o->tanggal_order->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                    <td><a href="{{ route('pesanan.show', $o->id_order) }}">Lihat</a></td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection