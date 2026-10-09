@extends('layouts.app')

@section('judul', 'Login')

@section('isi')
    <h1>Login</h1>
    <p>Login diperlukan untuk memasukkan barang ke keranjang dan checkout.</p>

    @error('username')
        <div class="alert error">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <p>
            <label>Username</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </p>
        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>
        <button class="btn" type="submit">Masuk</button>
    </form>
@endsection