<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Toko Alat Tulis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 760px;
            margin: 0 auto;
            padding: 16px;
            color: #222
        }

        .bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #1a57a0;
            padding-bottom: 10px;
            margin-bottom: 16px
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #1a57a0;
            text-decoration: none
        }

        .row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #ddd
        }

        .row .info {
            flex: 1
        }

        .img {
            width: 48px;
            height: 48px;
            background: #dbe7f5;
            color: #1a57a0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border-radius: 6px
        }

        .btn {
            background: #1a57a0;
            color: #fff;
            border: 0;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px
        }

        .btn:disabled {
            background: #aaa;
            cursor: not-allowed
        }

        .btn.danger {
            background: #c0392b
        }

        .qty {
            min-width: 24px;
            text-align: center
        }

        .alert {
            padding: 8px 12px;
            border-radius: 5px;
            margin-bottom: 12px
        }

        .ok {
            background: #e3f6e8;
            color: #1a7f37
        }

        .err {
            background: #fde8e6;
            color: #c0392b
        }

        form {
            margin: 0
        }
    </style>
</head>

<body>
    <div class="bar">
        <a class="brand" href="{{ route('barang.index') }}">Toko Alat Tulis</a>
        <a class="btn" href="{{ route('keranjang.index') }}">Keranjang ({{ array_sum(session('keranjang', [])) }})</a>
    </div>

    @if (session('sukses'))
    <div class="alert ok">{{ session('sukses') }}</div> @endif
    @if (session('error'))
    <div class="alert err">{{ session('error') }}</div> @endif

    @yield('isi')
</body>

</html>