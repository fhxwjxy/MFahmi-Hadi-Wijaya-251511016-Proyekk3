@extends('layouts.app')

@section('judul', 'Keranjang')

@section('isi')
    <h1>Keranjang Belanja</h1>

    @if (empty($items))
        <p>Keranjang masih kosong.</p>
        <a class="btn" href="{{ route('produk.index') }}">Lihat daftar barang</a>
    @else
        <table>
            <tr>
                <th>Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td>
                        {{ $item['produk']->nama_barang }}<br>
                        <small>Stok tersedia: {{ $item['produk']->stok }}</small>
                    </td>
                    <td>Rp {{ number_format($item['produk']->harga, 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="{{ route('keranjang.ubah', $item['produk']->id_barang) }}" class="inline">
                            @csrf
                            <button class="btn btn-kecil" name="aksi" value="kurang">-</button>
                            {{ $item['jumlah'] }}
                            <button class="btn btn-kecil" name="aksi" value="tambah">+</button>
                        </form>
                    </td>
                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="{{ route('keranjang.hapus', $item['produk']->id_barang) }}" class="inline">
                            @csrf
                            <button class="btn btn-merah btn-kecil" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <form method="POST" action="{{ route('keranjang.kosongkan') }}" class="inline">
            @csrf
            <button class="btn btn-merah" type="submit">Kosongkan keranjang</button>
        </form>

        <h2>Checkout</h2>
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <p>
                <label>Alamat pengiriman</label><br>
                <textarea name="alamat_pengiriman" rows="3" style="width:100%"
                    required>{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>
            </p>
            @error('alamat_pengiriman')
                <div class="alert error">{{ $message }}</div>
            @enderror
            <button class="btn" type="submit">Checkout</button>
        </form>
    @endif
@endsection