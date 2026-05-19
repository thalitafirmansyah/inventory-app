@extends('layouts.petugas')

@section('title', 'Data Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Barang</h2>
    <a href="{{ route('petugas.products.create') }}" class="btn btn-primary">
        + Tambah Barang
    </a>
</div>

<!-- Form Pencarian -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('petugas.products') }}" class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white border-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari berdasarkan nama barang atau kode barang..." 
                           value="{{ request('search') }}" style="border-left: none;">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('petugas.products') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    @endif
                </div>
                <small class="text-muted mt-1 d-block">
                    <i class="fas fa-info-circle"></i> Cari berdasarkan nama barang atau kode barang
                </small>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr class="{{ $product->stok <= 5 ? 'table-warning' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->kode_barang }}</td>
                        <td>
                            @if($product->gambar)
                                <img src="{{ asset('uploads/products/'.$product->gambar) }}" width="50" height="50" class="rounded">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $product->nama_barang }}</td>
                        <td>
                            <span class="badge bg-{{ $product->stok > 0 ? ($product->stok <= 5 ? 'warning' : 'success') : 'danger' }}">
                                {{ number_format($product->stok) }}
                            </span>
                        </td>
                        <td>{{ $product->satuan }}</td>
                        <td>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#stockInModal{{ $product->id }}">+ Masuk</button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#stockOutModal{{ $product->id }}">- Keluar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            @if(request('search'))
                                Tidak ada hasil pencarian untuk "{{ request('search') }}"
                            @else
                                Belum ada data barang
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($products as $product)
<!-- Modal Stock In -->
<div class="modal fade" id="stockInModal{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('petugas.stock.in', $product->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Barang Masuk - {{ $product->nama_barang }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Stok Saat Ini</label>
                        <input type="text" class="form-control" value="{{ $product->stok }} {{ $product->satuan }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah Masuk</label>
                        <input type="number" name="jumlah" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Pembelian dari supplier"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah Stok</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Stock Out -->
<div class="modal fade" id="stockOutModal{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('petugas.stock.out', $product->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Barang Keluar - {{ $product->nama_barang }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Stok Saat Ini</label>
                        <input type="text" class="form-control" value="{{ $product->stok }} {{ $product->satuan }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah Keluar</label>
                        <input type="number" name="jumlah" class="form-control" required min="1" max="{{ $product->stok }}">
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Penjualan ke customer"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Kurangi Stok</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection