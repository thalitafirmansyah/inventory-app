{{-- resources/views/admin/racks/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Rak')

@section('content')
<h2>Tambah Rak</h2>

<form method="POST" action="/admin/racks">
    @csrf
    <div class="mb-3">
        <label>Nama Rak</label>
        <input type="text" name="nama_rak" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/admin/racks" class="btn btn-secondary">Batal</a>
</form>
@endsection