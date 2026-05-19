{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pengguna</h2>
    <a href="/admin/users/create" class="btn btn-primary">Tambah Pengguna</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->nama_lengkap }}</td>
                <td>
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'success' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    @if($user->id != session('user')['id'])
                    <form action="/admin/users/{{ $user->id }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection