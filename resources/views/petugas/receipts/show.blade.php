{{-- resources/views/petugas/receipts/show.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Detail Tanda Terima')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('petugas.receipts.print', $receipt->id) }}" class="btn btn-secondary" target="_blank">
        <i class="fas fa-print"></i> Print
    </a>
    <a href="{{ route('petugas.receipts.index') }}" class="btn btn-secondary ms-2">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="text-center mb-4">
            <h2>TANDA TERIMA BARANG</h2>
            <p>No. {{ $receipt->no_receipt }}</p>
        </div>

        <table class="table table-bordered">
            <tr><th width="40%">Tanggal</th><td>{{ $receipt->tanggal->format('d/m/Y') }}</td></tr>
            <tr><th>Nama Barang</th><td>{{ $receipt->product->nama_barang }}</td></tr>
            <tr><th>Kode Barang</th><td>{{ $receipt->product->kode_barang }}</td></tr>
            <tr><th>Jumlah</th><td>{{ number_format($receipt->jumlah) }} {{ $receipt->product->satuan }}</td></tr>
            <tr><th>Tipe</th>
                <td>
                    @if($receipt->type == 'in')
                        <span class="badge bg-success">Barang Masuk</span>
                    @else
                        <span class="badge bg-danger">Barang Keluar</span>
                    @endif
                </td>
            </tr>
            @if($receipt->tujuan)
            <tr><th>Tujuan Pengiriman</th><td>{{ $receipt->tujuan }}</td></tr>
            @endif
            @if($receipt->penerima)
            <tr><th>Penerima</th><td>{{ $receipt->penerima }}</td></tr>
            @endif
            @if($receipt->keterangan)
            <tr><th>Keterangan</th><td>{{ $receipt->keterangan }}</td></tr>
            @endif
            <tr><th>Dibuat Oleh</th><td>{{ $receipt->creator->nama_lengkap }}</td></tr>
        </table>

        <div class="row mt-5">
            <div class="col-6 text-center">
                <p>Penerima,</p>
                <br><br>
                <p>({{ $receipt->penerima ?? '_____________' }})</p>
            </div>
            <div class="col-6 text-center">
                <p>Petugas,</p>
                <br><br>
                <p>({{ $receipt->creator->nama_lengkap }})</p>
            </div>
        </div>
    </div>
</div>
@endsection