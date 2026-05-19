@extends('layouts.petugas')

@section('title', 'Laporan Stok')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📊 Laporan Barang Masuk & Keluar</h2>
    <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>

<!-- Form Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('petugas.reports.stock') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-control">
                    <option value="">Semua</option>
                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Barang Keluar</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('petugas.reports.stock') }}" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Laporan -->
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">📋 Data Mutasi Stok</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Stok Sebelum</th>
                        <th>Stok Sesudah</th>
                        <th>Keterangan</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockMutations as $index => $item)
                    <tr>
                        <td>{{ $stockMutations->firstItem() + $index }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $item->product->kode_barang ?? '-' }}</td>
                        <td>{{ $item->product->nama_barang ?? '-' }}</td>
                        <td>
                            @if($item->type == 'in')
                                <span class="badge bg-success">📥 Masuk</span>
                            @else
                                <span class="badge bg-danger">📤 Keluar</span>
                            @endif
                        </td>
                        <td>{{ number_format($item->jumlah) }} {{ $item->product->satuan ?? '' }}</td>
                        <td>{{ $item->product->satuan ?? '-' }}</td>
                        <td>{{ number_format($item->stok_sebelum) }}</td>
                        <td>{{ number_format($item->stok_sesudah) }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">
                            <i class="fas fa-database"></i> Belum ada data mutasi stok
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $stockMutations->links() }}
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection