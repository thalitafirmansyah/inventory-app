{{-- resources/views/petugas/products/create.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Tambah Barang')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Form Tambah Barang</h5></div>
    <div class="card-body">
        <form action="{{ route('petugas.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label>Nama Barang <span class="text-danger">*</span></label><input type="text" name="nama_barang" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Satuan <span class="text-danger">*</span></label>
                    <select name="satuan" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="Pcs">Pcs</option><option value="Unit">Unit</option><option value="Pack">Pack</option>
                        <option value="Dus">Dus</option><option value="Karton">Karton</option><option value="Kg">Kg</option><option value="Liter">Liter</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label>Stok Awal</label><input type="number" name="stok" class="form-control" value="0" min="0" required></div>
                <div class="col-md-6 mb-3"><label>Harga Beli (Rp)</label><input type="number" name="harga_beli" class="form-control" min="0" required></div>
                <div class="col-md-12 mb-3"><label>Gambar</label><input type="file" name="gambar" class="form-control" accept="image/*"><small class="text-muted">JPG, PNG, Max 2MB</small></div>
                <div class="col-md-12"><button type="submit" class="btn btn-primary">Simpan</button><a href="{{ route('petugas.products') }}" class="btn btn-secondary">Batal</a></div>
            </div>
        </form>
    </div>
</div>
@endsection