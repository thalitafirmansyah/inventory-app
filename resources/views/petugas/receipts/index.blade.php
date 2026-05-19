{{-- resources/views/petugas/receipts/index.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Tanda Terima Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📄 Tanda Terima Barang</h2>
    <a href="{{ route('petugas.receipts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Buat Tanda Terima
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>No. Tanda Terima</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Penerima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($receipts as $receipt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $receipt->no_receipt }}</td>
                        <td>{{ $receipt->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $receipt->product->nama_barang ?? '-' }}</td>
                        <td>
                            @if($receipt->type == 'in')
                                <span class="badge bg-success">Masuk</span>
                            @else
                                <span class="badge bg-danger">Keluar</span>
                            @endif
                        </td>
                        <td>{{ number_format($receipt->jumlah) }} {{ $receipt->product->satuan ?? '' }}</td>
                        <td>{{ $receipt->penerima ?? '-' }}</td>
                        <td>
                            <a href="{{ route('petugas.receipts.show', $receipt->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('petugas.receipts.print', $receipt->id) }}" class="btn btn-sm btn-secondary" target="_blank">Print</a>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">Belum ada tanda terima</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $receipts->links() }}
    </div>
</div>
@endsection