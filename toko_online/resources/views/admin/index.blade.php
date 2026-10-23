@extends('layouts.app')

@section('judul', 'Daftar Barang')

@section('isi')
    <h1>Daftar Barang</h1>

    <div class="grid">
        @foreach ($produk as $p)
            <div class="card">
                @if ($p->gambar && file_exists(public_path('images/products/' . $p->gambar)))
                    <img src="{{ asset('images/products/' . $p->gambar) }}" alt="{{ $p->nama_barang }}">
                @else
                    <div class="noimg">Tidak ada gambar</div>
                @endif

                <h3>{{ $p->nama_barang }}</h3>
                <p>{{ $p->deskripsi }}</p>
                <p><strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong></p>
                <p>Stok: {{ $p->stok }}</p>

                @auth
                    @if ($p->stok > 0)
                        <form method="POST" action="{{ route('keranjang.tambah', $p->id_barang) }}">
                            @csrf
                            <button class="btn" type="submit">Masukkan ke keranjang</button>
                        </form>
                    @else
                        <button class="btn" disabled>Stok habis</button>
                    @endif
                @else
                    <a class="btn" href="{{ route('login') }}">Login untuk membeli</a>
                @endauth
            </div>
        @endforeach
    </div>
@endsection