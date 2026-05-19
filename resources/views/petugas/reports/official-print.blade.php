<!-- {{-- resources/views/reports/official-print.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Laporan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        @media print {
            body { padding: 0; }
        }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin-bottom: 5px; }
        .periode { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BERITA ACARA LAPORAN BARANG</h1>
        <p>Inventory System</p>
    </div>

    <div class="periode">
        <p><strong>Periode:</strong> {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Barang Masuk</h5>
                    <h2>{{ number_format($totalMasuk) }} unit</h2>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Barang Keluar</h5>
                    <h2>{{ number_format($totalKeluar) }} unit</h2>
                </div>
            </div>
        </div>
    </div>

    <h5>A. Detail Barang Masuk</h5>
    <table class="table table-bordered">
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Kode</th><th>Nama Barang</th><th>Jumlah</th><th>Satuan</th><th>Keterangan</th></tr>
        </thead>
        <tbody>
            @forelse($stockIn as $item)
            <tr>
                <td>{{ $loop->iteration }}</td><td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ $item->product->kode_barang ?? '-' }}</td>
                <td>{{ $item->product->nama_barang ?? '-' }}</td>
                <td>{{ number_format($item->jumlah) }}</td>
                <td>{{ $item->product->satuan ?? '-' }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty<td colspan="7" class="text-center">Tidak ada data</td>@endforelse
        </tbody>
    </table>

    <h5>B. Detail Barang Keluar</h5>
    <table class="table table-bordered">
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Kode</th><th>Nama Barang</th><th>Jumlah</th><th>Satuan</th><th>Keterangan</th></tr>
        </thead>
        <tbody>
            @forelse($stockOut as $item)
            <tr>
                <td>{{ $loop->iteration }}</td><td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ $item->product->kode_barang ?? '-' }}</td>
                <td>{{ $item->product->nama_barang ?? '-' }}</td>
                <td>{{ number_format($item->jumlah) }}</td>
                <td>{{ $item->product->satuan ?? '-' }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty<td colspan="7" class="text-center">Tidak ada data</td>@endforelse
        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-4 text-center"><p>Mengetahui,</p><br><br><p>(_________________)</p></div>
        <div class="col-4 text-center"><p>Petugas,</p><br><br><p>(_________________)</p></div>
        <div class="col-4 text-center"><p>Dicetak,</p><br><br><p>{{ date('d/m/Y H:i:s') }}</p></div>
    </div>

    <script>window.print();</script>
</body>
</html> -->