{{-- resources/views/petugas/receipts/create.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Buat Tanda Terima')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Buat Tanda Terima Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('petugas.receipts.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pilih Barang <span class="text-danger">*</span></label>
                    <select name="product_id" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->kode_barang }} - {{ $product->nama_barang }} (Stok: {{ $product->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipe <span class="text-danger">*</span></label>
                    <select name="type" class="form-control" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="in">Barang Masuk</option>
                        <option value="out">Barang Keluar</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah" class="form-control" required min="1">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tujuan Pengiriman</label>
                    <input type="text" name="tujuan" class="form-control" placeholder="Contoh: Kantor Cabang Jakarta">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" name="penerima" class="form-control" placeholder="Nama orang yang menerima">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan tambahan"></textarea>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Simpan Tanda Terima</button>
                    <a href="{{ route('petugas.receipts.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection