{{-- resources/views/petugas/requests/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Pengajuan Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Riwayat Pengajuan Saya</h2>
    <a href="/petugas/requests/create" class="btn btn-primary">Ajukan Barang Baru</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Disetujui Oleh</th>
                <th>Tanggal Diproses</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
            <tr>
                <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $request->product->nama_barang }}</td>
                <td>{{ $request->jumlah }} {{ $request->product->satuan }}</td>
                <td>{{ $request->keterangan ?? '-' }}</td>
                <td>
                    @if($request->status == 'pending')
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @elseif($request->status == 'approved')
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </td>
                <td>
                    @if($request->approved_by)
                        {{ $request->approver->nama_lengkap ?? '-' }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $request->approved_at ? $request->approved_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada pengajuan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection