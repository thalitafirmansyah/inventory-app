@extends('layouts.petugas')

@section('title', 'Stok Menipis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>⚠️ Peringatan Stok Menipis</h2>
    <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0">Daftar Barang dengan Stok ≤ 5</h5>
    </div>
    <div class="card-body">
        @if($lowStockProducts->count() > 0)
            <div class="row">
                @foreach($lowStockProducts as $product)
                <div class="col-md-4 mb-3">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <strong>{{ $product->kode_barang }}</strong>
                        </div>
                        <div class="card-body text-center">
                            @if($product->gambar)
                                <img src="{{ asset('uploads/products/'.$product->gambar) }}" class="img-fluid rounded mb-3" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-secondary text-white p-5 mb-3 rounded">No Image</div>
                            @endif
                            <h5>{{ $product->nama_barang }}</h5>
                            <p class="text-danger"><strong>Stok: {{ $product->stok }} {{ $product->satuan }}</strong></p>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#stockInModal{{ $product->id }}">+ Tambah Stok</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-success text-center">✅ Semua barang dalam stok aman (≥ 6)</div>
        @endif
    </div>
</div>

@foreach($lowStockProducts as $product)
<div class="modal fade" id="stockInModal{{ $product->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('petugas.stock.in', $product->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white"><h5 class="modal-title">Tambah Stok - {{ $product->nama_barang }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Stok Saat Ini</label><input type="text" class="form-control" value="{{ $product->stok }} {{ $product->satuan }}" disabled></div>
                    <div class="mb-3"><label>Jumlah Tambahan</label><input type="number" name="jumlah" class="form-control" min="1" required></div>
                    <div class="mb-3"><label>Keterangan</label><textarea name="keterangan" class="form-control" rows="2"></textarea></div>
                </div>
                <div class="modal-footer"><button class="btn btn-success">Tambah</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button></div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection