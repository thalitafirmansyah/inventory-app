@extends('layouts.app')

@section('title', 'Peringatan Stok Menipis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>⚠️ Peringatan: Barang dengan Stok Menipis (≤ 5)</h2>
    <a href="/admin/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>

<div class="card">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0">Daftar Barang yang Perlu Segera Diisi Ulang</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Saat Ini</th>
                        <th>Satuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockProducts as $product)
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
                        <td class="text-center text-danger">
                            <strong>{{ number_format($product->stok) }}</strong>
                        </td>
                        <td class="text-center">{{ $product->satuan }}</td>
                        <td>
                            @if($product->stok <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @else
                                <span class="badge bg-warning text-dark">Menipis (≤ 5)</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-success">
                            ✅ Semua barang dalam stok aman (≥ 6)
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection