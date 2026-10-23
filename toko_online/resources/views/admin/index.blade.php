@extends('layouts.app')

@section('judul', 'Kelola Role')

@section('isi')
    <h2>Kelola Role Pengguna</h2>

    @if (session('status'))
        <p style="color:green">{{ session('status') }}</p>
    @endif
    @error('role')
        <p style="color:red">{{ $message }}</p>
    @enderror

    <table border="1" cellpadding="6" style="background:#fff">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Role saat ini</th>
            <th>Ubah ke</th>
        </tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id_user }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->nama_lengkap }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.role.update', $u) }}">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            <option value="customer">customer</option>
                            <option value="staff">staff</option>
                        </select>
                        <button class="btn" type="submit">Ubah</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection