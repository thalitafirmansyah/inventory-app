{{-- resources/views/admin/racks/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Rak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Rak</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRackModal">
        Tambah Rak
    </button>
</div>

<div class="row">
    @foreach($racks as $rack)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5>{{ $rack->kode_rak }} - {{ $rack->nama_rak }}</h5>
                <small>Lokasi: {{ $rack->lokasi }}</small>
            </div>
            <div class="card-body">
                <h6>Daftar Barang di Rak Ini:</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Gambar</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rack->products as $product)
                            <tr>
                                <td>{{ $product->kode_barang }}</td>
                                <td>{{ $product->nama_barang }}</td>
                                <td>
                                    @if($product->gambar)
                                        <img src="{{ asset('uploads/products/'.$product->gambar) }}" width="40" height="40">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ number_format($product->stok) }}</td>
                                <td>{{ $product->satuan }}</td>
                                <td>{{ $product->supplier->nama_supplier }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada barang di rak ini</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-warning" onclick="editRack({{ $rack->id }})">Edit Rak</button>
                <form action="{{ route('admin.racks.destroy', $rack->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus rak ini?')">Hapus Rak</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

<script>
function editRack(id) {
    alert("Edit Rack ID: " + id);
}
</script>