@extends('layout')
@section('judul', 'Keranjang')
@section('isi')
    <h2>Keranjang belanja <small></small></h2>

    @forelse ($items as $it)
        <div class="row">
            <div class="info">
                <strong>{{ $it['barang']->nama }}</strong><br>
                Rp {{ number_format($it['barang']->harga, 0, ',', '.') }} x {{ $it['jumlah'] }}
                = Rp {{ number_format($it['subtotal'], 0, ',', '.') }}
            </div>
            <form method="POST" action="{{ route('keranjang.kurang', $it['barang']->id) }}">
                @csrf <button class="btn">-</button>
            </form>
            <span class="qty">{{ $it['jumlah'] }}</span>
            <form method="POST" action="{{ route('keranjang.tambah', $it['barang']->id) }}">
                @csrf <button class="btn">+</button>
            </form>
            <form method="POST" action="{{ route('keranjang.hapus', $it['barang']->id) }}">
                @csrf @method('DELETE') <button class="btn danger">hps</button>
            </form>
        </div>
    @empty
        <p>Keranjang kosong.</p>
    @endforelse

    @if (count($items) > 0)
        <h3>Total Rp {{ number_format($total, 0, ',', '.') }}</h3>
        <form method="POST" action="{{ route('keranjang.kosongkan') }}">
            @csrf @method('DELETE')
            <button class="btn danger">Kosongkan keranjang</button>
        </form>
    @endif

    <p><a href="{{ route('barang.index') }}">&laquo; Kembali ke daftar barang</a></p>
@endsection