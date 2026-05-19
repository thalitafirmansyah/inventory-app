{{-- resources/views/reports/official.blade.php --}}
@extends('layouts.app')

@section('title', 'Berita Acara Laporan Barang')

@section('content')
<h2 class="mb-4">📋 Berita Acara Laporan Barang</h2>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('reports.official') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Tampilkan</button>
                <a href="{{ route('reports.official.print', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-secondary" target="_blank">Print</a>
            </div>
        </form>
    </div>
</div>

<!-- Ringkasan -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Total Barang Masuk</h5>
                <h2>{{ number_format($totalMasuk) }} unit</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5>Total Barang Keluar</h5>
                <h2>{{ number_format($totalKeluar) }} unit</h2>
            </div>
        </div>
    </div>
</div>

<!-- Detail Masuk -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <h5>Detail Barang Masuk</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>No</th><th>Tanggal</th><th>Kode</th><th>Nama Barang</th><th>Jumlah</th><th>Satuan</th><th>Keterangan</th></tr>
                </thead>
                <tbody>
                    @forelse($stockIn as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->product->kode_barang ?? '-' }}</td>
                        <td>{{ $item->product->nama_barang ?? '-' }}</td>
                        <td>{{ number_format($item->jumlah) }}</td>
                        <td>{{ $item->product->satuan ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                        <td><td colspan="7" class="text-center">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Keluar -->
<div class="card">
    <div class="card-header bg-danger text-white">
        <h5>Detail Barang Keluar</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>No</th><th>Tanggal</th><th>Kode</th><th>Nama Barang</th><th>Jumlah</th><th>Satuan</th><th>Keterangan</th></tr>
                </thead>
                <tbody>
                    @forelse($stockOut as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->product->kode_barang ?? '-' }}</td>
                        <td>{{ $item->product->nama_barang ?? '-' }}</td>
                        <td>{{ number_format($item->jumlah) }}</td>
                        <td>{{ $item->product->satuan ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                        <td><td colspan="7" class="text-center">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-muted text-center mt-4">
    <small>Dicetak pada: {{ date('d/m/Y H:i:s') }}</small>
</div>
@endsection