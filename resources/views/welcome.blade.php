{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Efek bintang / ornamen */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(2px 2px at 20px 30px, #fff, rgba(0,0,0,0));
            background-size: 40px 40px;
            opacity: 0.2;
            pointer-events: none;
        }

        .hero-section {
            width: 100%;
            max-width: 1200px;
            margin: 20px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-area i {
            font-size: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-area h1 {
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-top: 10px;
        }

        .logo-area p {
            color: #666;
            font-size: 16px;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin: 40px 0;
        }

        .feature-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            width: 200px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            border: 1px solid #e0e0e0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-card i {
            font-size: 40px;
            color: #667eea;
            margin-bottom: 15px;
        }

        .feature-card h5 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 12px;
            color: #777;
        }

        .cta-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .btn-custom {
            padding: 12px 35px;
            border-radius: 40px;
            font-weight: 600;
            margin: 0 10px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-register {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-register:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
        }

        .footer-landing {
            text-align: center;
            margin-top: 40px;
            color: #aaa;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 30px 20px;
                margin: 10px;
            }
            .feature-card {
                width: 160px;
                padding: 15px;
            }
            .btn-custom {
                padding: 10px 25px;
                margin: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="logo-area">
            <i class="fas fa-boxes"></i>
            <h1>Inventory System</h1>
            <p>Solusi pintar mengelola stok barang Anda</p>
        </div>

        <div class="features">
            <div class="feature-card">
                <i class="fas fa-chart-line"></i>
                <h5>Dashboard</h5>
                <p>Pantau stok barang secara realtime</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-box"></i>
                <h5>Kelola Barang</h5>
                <p>Tambah, edit, hapus barang dengan mudah</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-qrcode"></i>
                <h5>Barcode Scanner</h5>
                <p>Scan barcode untuk cek stok</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-file-alt"></i>
                <h5>Laporan</h5>
                <p>Cetak tanda terima & laporan stok</p>
            </div>
        </div>

        <div class="cta-buttons">
            <a href="/login" class="btn-custom btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="/login" class="btn-custom btn-register">
                <i class="fas fa-user-plus"></i> Register
            </a>
        </div>

    </div>
</body>
</html>