<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <p>Selamat datang, {{ auth()->user()->nama_lengkap }}!</p>
    <p>Halaman ini hanya bisa dibuka setelah login.</p>
    <p>Username: {{ auth()->user()->username }}</p>
</body>

</html>