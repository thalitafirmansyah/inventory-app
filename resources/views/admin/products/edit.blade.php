@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="card">
    <div class="card-header bg-warning text-white">
        <h5 class="mb-0">Edit Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" value="{{ $product->kode_barang }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $product->nama_barang) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Satuan <span class="text-danger">*</span></label>
                    <select name="satuan" class="form-control" required>
                        <option value="Pcs" {{ $product->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Unit" {{ $product->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Pack" {{ $product->satuan == 'Pack' ? 'selected' : '' }}>Pack</option>
                        <option value="Dus" {{ $product->satuan == 'Dus' ? 'selected' : '' }}>Dus</option>
                        <option value="Karton" {{ $product->satuan == 'Karton' ? 'selected' : '' }}>Karton</option>
                        <option value="Kg" {{ $product->satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                        <option value="Liter" {{ $product->satuan == 'Liter' ? 'selected' : '' }}>Liter</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $product->stok) }}" required min="0">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Beli (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli', $product->harga_beli) }}" required min="0" step="1000">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    @if($product->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/products/'.$product->gambar) }}" width="150" class="rounded border">
                        </div>
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                    
                    <label for="gambar" class="form-label mt-2">Ganti Gambar</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update Barang</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection