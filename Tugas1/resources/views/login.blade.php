<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <p>Masuk untuk membuka dashboard</p>

    @error('username')
        <p style="color:red">{{ $message }}</p>
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
        <button type="submit">Masuk</button>
    </form>
</body>

</html>