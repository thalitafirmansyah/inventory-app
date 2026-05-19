{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Tambah Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                           id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                    @error('nama_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                    <select class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required>
                        <option value="">Pilih Satuan</option>
                        <option value="Pcs" {{ old('satuan') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Unit" {{ old('satuan') == 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Pack" {{ old('satuan') == 'Pack' ? 'selected' : '' }}>Pack</option>
                        <option value="Dus" {{ old('satuan') == 'Dus' ? 'selected' : '' }}>Dus</option>
                        <option value="Karton" {{ old('satuan') == 'Karton' ? 'selected' : '' }}>Karton</option>
                        <option value="Kg" {{ old('satuan') == 'Kg' ? 'selected' : '' }}>Kg</option>
                        <option value="Liter" {{ old('satuan') == 'Liter' ? 'selected' : '' }}>Liter</option>
                    </select>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok Awal <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                           id="stok" name="stok" value="{{ old('stok', 0) }}" required min="0">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" 
                           id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" required min="0">
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="gambar" class="form-label">Gambar Barang</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                           id="gambar" name="gambar" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, GIF (Max 2MB)</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Simpan Barang</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview gambar sebelum upload
    document.getElementById('gambar').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('div');
                preview.innerHTML = `<img src="${e.target.result}" width="150" class="mt-2 rounded">`;
                document.getElementById('gambar').parentNode.appendChild(preview);
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection