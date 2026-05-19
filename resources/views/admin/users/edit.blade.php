{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<h2>Edit Pengguna</h2>

<form method="POST" action="/admin/users/{{ $user->id }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
    </div>
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}" required>
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Password (Kosongkan jika tidak diubah)</label>
        <input type="password" name="password" class="form-control">
        <small class="text-muted">Isi hanya jika ingin mengganti password</small>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/admin/users" class="btn btn-secondary">Batal</a>
</form>
@endsection