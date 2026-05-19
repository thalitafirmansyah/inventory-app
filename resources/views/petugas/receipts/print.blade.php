<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tanda Terima - {{ $receipt->no_receipt }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', 'Poppins', serif;
            background: #e8f0fe;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 30px;
        }
        
        .surat-container {
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 40px;
            position: relative;
        }
        
        /* Watermark */
        .surat-container::before {
            content: "📦 INVENTORY SYSTEM";
            position: absolute;
            bottom: 30px;
            right: 30px;
            font-size: 50px;
            opacity: 0.03;
            font-weight: bold;
            transform: rotate(-15deg);
            pointer-events: none;
        }
        
        /* Header / Kop Surat */
        .kop-surat {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #2c3e66;
            padding-bottom: 20px;
        }
        
        .kop-surat h1 {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e66;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }
        
        .kop-surat h3 {
            font-size: 16px;
            color: #555;
            font-weight: normal;
        }
        
        .kop-surat p {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }
        
        /* Nomor Surat */
        .nomor-surat {
            text-align: center;
            margin: 15px 0 25px;
            padding: 8px;
            background: #f0f2f5;
            border-radius: 10px;
        }
        
        .nomor-surat p {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e66;
        }
        
        /* Informasi Barang */
        .info-barang {
            margin: 20px 0;
        }
        
        .info-barang h4 {
            background: linear-gradient(135deg, #2c3e66 0%, #3498db 100%);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .tabel-info {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background: #fafbfc;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .tabel-info td {
            padding: 12px 15px;
            border: 1px solid #e0e4e8;
        }
        
        .tabel-info td:first-child {
            width: 35%;
            background: #f0f2f5;
            font-weight: 600;
            color: #2c3e66;
        }
        
        .tabel-info td:last-child {
            color: #333;
        }
        
        /* Tanda Tangan */
        .ttd-section {
            margin-top: 40px;
        }
        
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .ttd-table td {
            width: 33%;
            text-align: center;
            vertical-align: top;
            padding-top: 20px;
        }
        
        .ttd-table .ttd-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .ttd-table .ttd-line {
            margin-top: 50px;
            border-top: 1px solid #999;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .ttd-table .ttd-name {
            margin-top: 10px;
            font-size: 12px;
            color: #333;
        }
        
        /* Footer */
        .footer-print {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        
        /* Badge Tipe */
        .badge-tipe {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-in {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-out {
            background: #f8d7da;
            color: #721c24;
        }
        
        /* Print Mode */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .surat-container {
                box-shadow: none;
                padding: 20px;
            }
            .no-print {
                display: none;
            }
            .badge-tipe {
                border: 1px solid #ccc;
            }
        }
        
        /* Tombol Print */
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .btn-print {
            background: #2c3e66;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 14px;
            margin: 0 5px;
            transition: all 0.3s;
        }
        
        .btn-print:hover {
            background: #1e2a4a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-close {
            background: #6c757d;
        }
        
        .btn-close:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" class="btn-print">
            🖨️ Cetak / Print
        </button>
        <button onclick="window.close()" class="btn-print btn-close">
            ✖ Tutup
        </button>
    </div>

    <div class="surat-container" id="printArea">
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <h1>📄 TANDA TERIMA BARANG</h1>
            <h3>INVENTORY SYSTEM</h3>
            <!-- <p>Jl. Akses Raya No. 123, Kota Bekasi | Telp. (021) 1234-5678 | Email: inventory@system.com</p> -->
        </div>

        <!-- NOMOR SURAT -->
        <div class="nomor-surat">
            <p>Nomor : {{ $receipt->no_receipt }}</p>
        </div>

        <!-- INFORMASI BARANG -->
        <div class="info-barang">
            <h4> DETAIL BARANG</h4>
            <table class="tabel-info">
                <tr><td> Tanggal</td><td><strong>{{ \Carbon\Carbon::parse($receipt->tanggal)->format('d F Y') }}</strong></td></tr>
                <tr><td> Nama Barang</td><td><strong>{{ $receipt->product->nama_barang ?? '-' }}</strong></td></tr>
                <tr><td> Kode Barang</td><td><strong>{{ $receipt->product->kode_barang ?? '-' }}</strong></td></tr>
                <tr><td> Jumlah</td><td><strong>{{ number_format($receipt->jumlah) }} {{ $receipt->product->satuan ?? '' }}</strong></td></tr>
                <tr><td> Tipe</td>
                    <td>
                        @if($receipt->type == 'in')
                            <span class="badge-tipe badge-in">BARANG MASUK (Penerimaan)</span>
                        @else
                            <span class="badge-tipe badge-out"> BARANG KELUAR (Pengiriman)</span>
                        @endif
                    </td>
                </tr>
                @if($receipt->tujuan)
                <tr><td> Tujuan / Pengirim</td><td><strong>{{ $receipt->tujuan }}</strong></td></tr>
                @endif
                @if($receipt->penerima)
                <tr><td> Penerima / Penyerah</td><td><strong>{{ $receipt->penerima }}</strong></td></tr>
                @endif
                @if($receipt->keterangan)
                <tr><td> Keterangan</td><td><i>{{ $receipt->keterangan }}</i></td></tr>
                @endif
            </table>
        </div>

        <!-- KETERANGAN TAMBAHAN -->
        <div style="margin-top: 15px; padding: 10px; background: #f8f9fc; border-radius: 10px;">
            <p style="font-size: 12px; color: #555;">
                <i class="fas fa-info-circle"></i> Barang telah diterima/dikirim dalam keadaan baik dan lengkap.
            </p>
        </div>

        <!-- TANDA TANGAN -->
        <div class="ttd-section">
            <table class="ttd-table">
                <tr>
                    <td>
                        <div class="ttd-label">Mengetahui / Pemberi</div>
                        <div class="ttd-line"></div>
                        <div class="ttd-name">{{ $receipt->tujuan ?? '(_________________)' }}</div>
                    </td>
                    <td>
                        <div class="ttd-label">Penerima</div>
                        <div class="ttd-line"></div>
                        <div class="ttd-name">{{ $receipt->penerima ?? '(_________________)' }}</div>
                    </td>
                    <td>
                        <div class="ttd-label">Petugas</div>
                        <div class="ttd-line"></div>
                        <div class="ttd-name">{{ $receipt->creator->nama_lengkap ?? '_________________' }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="footer-print">
            <p>Dokumen ini sah dan dibuat secara elektronik | Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <script>
        // Auto adjust print
        window.onbeforeprint = function() {
            document.body.style.background = 'white';
        };
        window.onafterprint = function() {
            document.body.style.background = '#e8f0fe';
        };
    </script>
</body>
</html>