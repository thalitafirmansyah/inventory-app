{{-- resources/views/petugas/dashboard.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard Petugas</h2>

<div class="row mb-4">
    <div class="col-md-4"><div class="card bg-primary text-white"><div class="card-body d-flex justify-content-between"><div><h6>Total Barang</h6><h2>{{ $totalProducts }}</h2></div><div class="fs-1">📦</div></div></div></div>
    <div class="col-md-4"><div class="card bg-success text-white"><div class="card-body d-flex justify-content-between"><div><h6>Total Stok</h6><h2>{{ number_format($totalStok) }}</h2></div><div class="fs-1">📊</div></div></div></div>
    <div class="col-md-4"><div class="card bg-warning text-dark"><div class="card-body d-flex justify-content-between"><div><h6>Stok Menipis</h6><h2>{{ $lowStockCount }}</h2></div><div class="fs-1">⚠️</div></div></div></div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card"><div class="card-header bg-info text-white"><h5>📈 Aktivitas Stok (30 Hari)</h5></div>
        <div class="card-body">
            <canvas id="stockActivityChart" height="200"></canvas>
            <div class="row mt-3 text-center">
                <div class="col-6"><div class="alert alert-success mb-0" style="cursor:pointer" onclick="showStockInDetail()"><strong>Barang Masuk</strong><br>{{ number_format($stockInLast30) }} unit<br><small>📋 Klik detail</small></div></div>
                <div class="col-6"><div class="alert alert-danger mb-0" style="cursor:pointer" onclick="showStockOutDetail()"><strong>Barang Keluar</strong><br>{{ number_format($stockOutLast30) }} unit<br><small>📋 Klik detail</small></div></div>
            </div>
        </div></div>
    </div>
    <div class="col-md-6">
        <div class="card"><div class="card-header text-white" style="background:#764ba2"><h5>🏆 Top 5 Stok Terbanyak</h5></div>
        <div class="card-body"><canvas id="topStockChart" height="200"></canvas></div></div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-danger text-white"><h5>⚠️ Stok Menipis (≤ 5)</h5></div>
    <div class="card-body">
        @if($lowStockProducts->count())
        <table class="table table-bordered"><thead class="table-danger"><tr><th>Gambar</th><th>Kode</th><th>Nama</th><th>Stok</th><th>Satuan</th><th>Aksi</th></tr></thead>
        <tbody>@foreach($lowStockProducts as $p)<tr><td>@if($p->gambar)<img src="{{ asset('uploads/products/'.$p->gambar) }}" width="40">@else-@endif</td><td>{{ $p->kode_barang }}</td><td>{{ $p->nama_barang }}</td><td class="text-danger fw-bold">{{ $p->stok }}</td><td>{{ $p->satuan }}</td><td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#stockInModal{{ $p->id }}">+ Tambah</button></td></tr>@endforeach</tbody></table>
        @else<div class="alert alert-success text-center">✅ Semua stok aman</div>@endif
    </div>
</div>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="modalStockInDetail" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-success text-white"><h5>📦 Detail Barang Masuk</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><table class="table table-bordered"><thead class="table-success"><tr><th>No</th><th>Tanggal</th><th>Gambar</th><th>Kode</th><th>Nama</th><th>Jumlah</th><th>Keterangan</th><th>Petugas</th></tr></thead><tbody>@forelse($stockInDetails as $i => $item)<tr><td>{{ $i+1 }}</td><td>{{ $item->created_at->format('d/m/Y H:i') }}</td><td>@if($item->product && $item->product->gambar)<img src="{{ asset('uploads/products/'.$item->product->gambar) }}" width="40">@else-@endif</td><td>{{ $item->product->kode_barang ?? '-' }}</td><td>{{ $item->product->nama_barang ?? '-' }}</td><td class="text-success fw-bold">{{ number_format($item->jumlah) }}</td><td>{{ $item->keterangan ?? '-' }}</td><td>{{ $item->user->nama_lengkap ?? '-' }}</td></tr>@empty<tr><td colspan="8" class="text-center">Belum ada data</td></tr>@endforelse</tbody></table></div></div></div></div>

<div class="modal fade" id="modalStockOutDetail" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5>📤 Detail Barang Keluar</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><table class="table table-bordered"><thead class="table-danger"><tr><th>No</th><th>Tanggal</th><th>Gambar</th><th>Kode</th><th>Nama</th><th>Jumlah</th><th>Keterangan</th><th>Petugas</th></tr></thead><tbody>@forelse($stockOutDetails as $i => $item)<tr><td>{{ $i+1 }}</td><td>{{ $item->created_at->format('d/m/Y H:i') }}</td><td>@if($item->product && $item->product->gambar)<img src="{{ asset('uploads/products/'.$item->product->gambar) }}" width="40">@else-@endif</td><td>{{ $item->product->kode_barang ?? '-' }}</td><td>{{ $item->product->nama_barang ?? '-' }}</td><td class="text-danger fw-bold">{{ number_format($item->jumlah) }}</td><td>{{ $item->keterangan ?? '-' }}</td><td>{{ $item->user->nama_lengkap ?? '-' }}</td></tr>@empty<tr><td colspan="8" class="text-center">Belum ada data</td></tr>@endforelse</tbody></table></div></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('stockActivityChart'), { type: 'bar', data: { labels: ['Masuk', 'Keluar'], datasets: [{ data: [{{ $stockInLast30 }}, {{ $stockOutLast30 }}], backgroundColor: ['#28a745', '#dc3545'] }] }, options: { responsive: true, scales: { y: { beginAtZero: true } } } });
    new Chart(document.getElementById('topStockChart'), { type: 'bar', data: { labels: {!! json_encode($topStockProducts->pluck('nama_barang')) !!}, datasets: [{ label: 'Jumlah Stok', data: {!! json_encode($topStockProducts->pluck('stok')) !!}, backgroundColor: '#667eea' }] }, options: { indexAxis: 'y', responsive: true, scales: { x: { beginAtZero: true } } } });
    function showStockInDetail() { new bootstrap.Modal(document.getElementById('modalStockInDetail')).show(); }
    function showStockOutDetail() { new bootstrap.Modal(document.getElementById('modalStockOutDetail')).show(); }
</script>

@foreach($lowStockProducts as $product)
<div class="modal fade" id="stockInModal{{ $product->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><form action="{{ route('petugas.stock.in', $product->id) }}" method="POST">@csrf<div class="modal-header bg-success text-white"><h5>Tambah Stok - {{ $product->nama_barang }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="mb-3"><label>Stok Saat Ini</label><input type="text" class="form-control" value="{{ $product->stok }} {{ $product->satuan }}" disabled></div><div class="mb-3"><label>Jumlah Tambahan</label><input type="number" name="jumlah" class="form-control" min="1" required></div><div class="mb-3"><label>Keterangan</label><textarea name="keterangan" class="form-control" rows="2"></textarea></div></div><div class="modal-footer"><button class="btn btn-success">Tambah</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button></div></form></div></div></div>
@endforeach
@endsection