{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h2>Dashboard Admin</h2>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary" style="cursor: pointer;" onclick="showTotalBarangDetail()">
            <div class="card-body">
                <h5 class="card-title">Total Barang</h5>
                <h2>{{ $totalProducts }}</h2>
                <small class="text-white-50">Klik untuk detail</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success" style="cursor: pointer;" onclick="showTotalStokDetail()">
            <div class="card-body">
                <h5 class="card-title">Total Stok</h5>
                <h2>{{ number_format($totalStok) }}</h2>
                <small class="text-white-50">Klik untuk detail</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-info" style="cursor: pointer;" onclick="showTotalNilaiDetail()">
            <div class="card-body">
                <h5 class="card-title">Total Nilai</h5>
                <h2>Rp {{ number_format($totalValue, 0, ',', '.') }}</h2>
                <small class="text-white-50">Klik untuk detail</small>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card bg-secondary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6>Total Aktivitas Petugas</h6><h3 class="mb-0">{{ $totalPetugasActions }}</h3><small>Semua waktu</small></div>
                <div class="fs-1">📋</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6>Barang Masuk</h6><h3 class="mb-0">{{ $totalStockIn }}</h3><small>Dari petugas</small></div>
                <div class="fs-1">📥</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6>Barang Keluar</h6><h3 class="mb-0">{{ $totalStockOut }}</h3><small>Dari petugas</small></div>
                <div class="fs-1">📤</div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-2">
    <div class="card-header bg-warning text-dark"><h5 class="mb-0">📦 Barang Terbaru</h5></div>
    <div class="card-body">
        <div class="row">
            @forelse($recentProducts as $product)
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    @if($product->gambar)
                        <img src="{{ asset('uploads/products/'.$product->gambar) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 150px;"><span class="text-white">No Image</span></div>
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->nama_barang }}</h6>
                        <p class="card-text small">
                            <strong>Kode:</strong> {{ $product->kode_barang }}<br>
                            <strong>Stok:</strong> <span class="badge bg-{{ $product->stok > 0 ? 'success' : 'danger' }}">{{ number_format($product->stok) }} {{ $product->satuan }}</span><br>
                            <strong>Harga Beli:</strong> Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12"><div class="alert alert-info">Belum ada data barang</div></div>
            @endforelse
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-dark text-white"><h5 class="mb-0">📜 Log Aktivitas Petugas</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr><th>No</th><th>Tanggal</th><th>Petugas</th><th>Gambar</th><th>Kode</th><th>Nama Barang</th><th>Aktivitas</th><th>Jumlah</th><th>Keterangan</th></tr>
                </thead>
                <tbody>
                    @forelse($activityLogs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        <td><span class="badge bg-info">{{ $log->user->nama_lengkap ?? '-' }}</span></td>
                        <td>@if($log->product && $log->product->gambar)<img src="{{ asset('uploads/products/'.$log->product->gambar) }}" width="40">@else-@endif</td>
                        <td>{{ $log->product->kode_barang ?? '-' }}</td>
                        <td>{{ $log->product->nama_barang ?? '-' }}</td>
                        <td>@if($log->type == 'in')<span class="badge bg-success">Masuk</span>@else<span class="badge bg-danger">Keluar</span>@endif</td>
                        <td>{{ number_format($log->jumlah) }} {{ $log->product->satuan ?? '' }}</td>
                        <td>{{ $log->keterangan ?? '-' }}</td>
                    </tr>
                    @empty<tr><td colspan="9" class="text-center">Belum ada aktivitas</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODALS --}}
<div class="modal fade" id="modalTotalBarang" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-primary text-white"><h5 class="modal-title">📦 Detail Barang</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><table class="table table-bordered"><thead class="table-primary"><tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Stok</th><th>Satuan</th></tr></thead><tbody>@foreach($allProducts as $i => $p)<tr><td>{{ $i+1 }}</td><td>{{ $p->kode_barang }}</td><td>{{ $p->nama_barang }}</td><td>{{ number_format($p->stok) }}</td><td>{{ $p->satuan }}</td></tr>@endforeach</tbody></table></div></div></div></div>

<div class="modal fade" id="modalTotalStok" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-success text-white"><h5 class="modal-title">📊 Detail Stok</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><p><strong>Total Stok:</strong> {{ number_format($totalStok) }} unit</p><hr><table class="table table-bordered"><thead class="table-success"><tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Stok</th><th>Satuan</th></tr></thead><tbody>@foreach($allProducts as $i => $p)<tr><td>{{ $i+1 }}</td><td>{{ $p->kode_barang }}</td><td>{{ $p->nama_barang }}</td><td>{{ number_format($p->stok) }}</td><td>{{ $p->satuan }}</td></tr>@endforeach</tbody></table></div></div></div></div>

<div class="modal fade" id="modalTotalNilai" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-info text-white"><h5 class="modal-title">💰 Detail Nilai</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><p><strong>Total Nilai:</strong> Rp {{ number_format($totalValue, 0, ',', '.') }}</p><hr><table class="table table-bordered"><thead class="table-info"><tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Stok</th><th>Harga Beli</th><th>Total Nilai</th></tr></thead><tbody>@foreach($allProducts as $i => $p)@php $nilai = $p->stok * $p->harga_beli; @endphp<tr><td>{{ $i+1 }}</td><td>{{ $p->kode_barang }}</td><td>{{ $p->nama_barang }}</td><td>{{ number_format($p->stok) }}</td><td>Rp {{ number_format($p->harga_beli, 0, ',', '.') }}</td><td>Rp {{ number_format($nilai, 0, ',', '.') }}</td></tr>@endforeach</tbody></table></div></div></div></div>

<script>
    function showTotalBarangDetail() { new bootstrap.Modal(document.getElementById('modalTotalBarang')).show(); }
    function showTotalStokDetail() { new bootstrap.Modal(document.getElementById('modalTotalStok')).show(); }
    function showTotalNilaiDetail() { new bootstrap.Modal(document.getElementById('modalTotalNilai')).show(); }
</script>
@endsection