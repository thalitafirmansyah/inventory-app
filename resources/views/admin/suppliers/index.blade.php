@extends('layouts.app')

@section('title', 'Kelola Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Supplier</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
        <i class="bi bi-plus-circle"></i> Tambah Supplier
    </button>
</div>

<div class="row">
    @foreach($suppliers as $supplier)
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-header bg-{{ $loop->iteration % 2 == 0 ? 'success' : 'primary' }} text-white">
                <h5>{{ $supplier->kode_supplier }} - {{ $supplier->nama_supplier }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Kontak:</strong> {{ $supplier->kontak }}</p>
                <p><strong>Alamat:</strong> {{ $supplier->alamat }}</p>
                <p><strong>Total Barang:</strong> {{ $supplier->products->count() }} item</p>
                <p><strong>Total Nilai:</strong> Rp {{ number_format($supplier->products->sum(function($item){ return $item->stok * $item->harga_beli; }), 0, ',', '.') }}
            <div class="card-footer">
                <button class="btn btn-sm btn-warning" onclick="editSupplier({{ $supplier->id }})">Edit</button>
                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus supplier ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="addSupplierModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.suppliers.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Supplier Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kontak (No. Telepon)</label>
                        <input type="text" name="kontak" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection