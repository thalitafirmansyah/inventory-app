@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<h2>Tambah Pengguna</h2>

<form method="POST" action="/admin/users">
    @csrf
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/admin/users" class="btn btn-secondary">Batal</a>
</form>
@endsection