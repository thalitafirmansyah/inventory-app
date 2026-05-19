{{-- resources/views/admin/products/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Foto Barang</h5>
            </div>
            <div class="card-body text-center">
                @if($product->gambar)
                    <img src="{{ asset('uploads/products/'.$product->gambar) }}" class="img-fluid rounded" alt="{{ $product->nama_barang }}">
                @else
                    <div class="alert alert-secondary">Tidak ada gambar</div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Informasi Lengkap Barang</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Kode Barang</th>
                        <td><strong>{{ $product->kode_barang }}</strong></td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $product->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $product->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>{{ $product->supplier->nama_supplier }} ({{ $product->supplier->kontak }})</td>
                    </tr>
                    <tr>
                        <th>Rak</th>
                        <td>{{ $product->rack->nama_rak }} - Lokasi: {{ $product->rack->lokasi }}</td>
                    </tr>
                    <tr>
                        <th>Stok Saat Ini</th>
                        <td>
                            <span class="badge bg-{{ $product->stok > 0 ? 'success' : 'danger' }} fs-6">
                                {{ number_format($product->stok) }} {{ $product->satuan }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Stok Minimum</th>
                        <td>{{ number_format($product->stok_minimum) }} {{ $product->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $product->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Margin Keuntungan</th>
                        <td class="text-success">
                            Rp {{ number_format($product->harga_jual - $product->harga_beli, 0, ',', '.') }}
                            ({{ round(($product->harga_jual - $product->harga_beli) / $product->harga_beli * 100) }}%)
                        </td>
                    </tr>
                    <tr>
                        <th>Total Nilai Stok</th>
                        <td>Rp {{ number_format($product->stok * $product->harga_beli, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $product->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Update</th>
                        <td>{{ $product->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Mutasi Stok -->
<div class="card mt-4">
    <div class="card-header bg-secondary text-white">
        <h5>Riwayat Mutasi Stok</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Stok Sebelum</th>
                        <th>Stok Sesudah</th>
                        <th>Petugas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product->stockMutations as $mutation)
                    <tr>
                        <td>{{ $mutation->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($mutation->type == 'in')
                                <span class="badge bg-success">Masuk (+)</span>
                            @else
                                <span class="badge bg-danger">Keluar (-)</span>
                            @endif
                        </td>
                        <td>{{ number_format($mutation->jumlah) }}</td>
                        <td>{{ number_format($mutation->stok_sebelum) }}</td>
                        <td>{{ number_format($mutation->stok_sesudah) }}</td>
                        <td>{{ $mutation->user->nama_lengkap }}</td>
                        <td>{{ $mutation->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada riwayat mutasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection