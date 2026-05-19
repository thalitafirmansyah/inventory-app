{{-- resources/views/admin/requests/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan Barang')

@section('content')
<h2>Verifikasi Pengajuan Barang</h2>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pengaju</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
            <tr>
                <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $request->user->nama_lengkap }}</td>
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
                    @if($request->status == 'pending')
                        <div class="btn-group">
                            <form action="/admin/requests/{{ $request->id }}/approve" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Setujui pengajuan ini?')">Setujui</button>
                            </form>
                            <form action="/admin/requests/{{ $request->id }}/reject" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak pengajuan ini?')">Tolak</button>
                            </form>
                        </div>
                    @else
                        <span class="text-muted">- Diproses oleh: {{ $request->approver->nama_lengkap ?? '-' }} -</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada pengajuan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection