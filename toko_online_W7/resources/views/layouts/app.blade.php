<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Toko Online</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        nav {
            background: #2c3e50;
            color: #fff;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
        }

        nav a {
            color: #fff;
            margin-left: 16px;
            text-decoration: none;
        }

        main {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 16px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }

        .card {
            background: #fff;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
        }

        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 6px;
        }

        .noimg {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee;
            color: #888;
            border-radius: 6px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background: #27ae60;
            color: #fff;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn[disabled] {
            background: #aaa;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ route('produk.index') }}"><strong>Toko Online</strong></a>
        <div>
            @auth
                <span>{{ auth()->user()->nama_lengkap }}</span>
                <a href="#">Keranjang</a>
                <a href="#">Pesanan</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button class="btn" type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('isi')
    </main>
</body>

</html>