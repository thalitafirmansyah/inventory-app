@extends('layouts.app')

@section('title', 'Top 5 Stok Terbanyak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>⭐ Top 5 Barang dengan Stok Terbanyak</h2>
    <a href="/admin/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Data Barang dengan Stok Terbanyak</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topStockProducts as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($product->gambar)
                                <img src="{{ asset('uploads/products/'.$product->gambar) }}" 
                                     width="50" height="50" style="object-fit: cover;" class="rounded">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $product->kode_barang }}</td>
                        <td>{{ $product->nama_barang }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary" style="font-size: 14px;">
                                {{ number_format($product->stok) }}
                            </span>
                        </td>
                        <td>{{ $product->satuan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection