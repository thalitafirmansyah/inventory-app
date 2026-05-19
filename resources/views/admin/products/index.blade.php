@extends('layouts.app')

@section('title', 'Kelola Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Barang</h2>
    <a href="/admin/products/create" class="btn btn-primary">Tambah Barang</a>
</div>

<!-- FORM PENCARIAN -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="/admin/products" class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white border-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari berdasarkan nama barang atau kode barang..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="/admin/products" class="btn btn-secondary">
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

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Harga Beli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->kode_barang }}</td>
                <td>{{ $product->nama_barang }}</td>
                <td>
                    @if($product->gambar)
                        <img src="{{ asset('uploads/products/'.$product->gambar) }}" width="50" height="50" style="object-fit: cover;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $product->stok }}</td>
                <td>{{ $product->satuan }}</td>
                <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                <td>
                    <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/admin/products/{{ $product->id }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">
                    @if(request('search'))
                        Tidak ada hasil pencarian untuk "<strong>{{ request('search') }}</strong>"
                    @else
                        Belum ada data barang
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection