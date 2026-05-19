@extends('layouts.app')

@section('title', 'Ajukan Barang')

@section('content')
<h2>Form Pengajuan Barang</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/petugas/requests">
                    @csrf
                    <div class="mb-3">
                        <label>Pilih Barang</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->kode_barang }} - {{ $product->nama_barang }} 
                                (Stok: {{ $product->stok }} {{ $product->satuan }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah yang Diajukan</label>
                        <input type="number" name="jumlah" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label>Keterangan / Alasan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Stok menipis, perlu restock..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajukan Permintaan</button>
                    <a href="/petugas/requests" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">Informasi</div>
            <div class="card-body">
                <h6>Peraturan Pengajuan:</h6>
                <ul>
                    <li>Pengajuan akan diproses oleh Admin</li>
                    <li>Status pengajuan dapat dilihat di menu Riwayat Pengajuan</li>
                    <li>Pengajuan yang disetujui akan otomatis menambah stok barang</li>
                    <li>Jika urgent, hubungi admin langsung</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection