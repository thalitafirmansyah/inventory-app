{{-- resources/views/layouts/petugas.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System (Petugas) - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', 'Poppins', sans-serif;
            color: #1a1a2e;
        }

        /* Navbar Atas */
        .navbar-top {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 12px 30px;
            border-bottom: 1px solid #e9ecef;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e66;
        }

        .navbar-brand i {
            color: #2c3e66;
            margin-right: 8px;
        }

        .user-info {
            background: #eef2ff;
            padding: 8px 18px;
            border-radius: 40px;
            color: #2c3e66;
            font-weight: 500;
            font-size: 14px;
        }

        .user-info i {
            margin-right: 8px;
            color: #2c3e66;
        }

        /* Menu Navigasi */
        .nav-menu {
            background: #ffffff;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.03);
            padding: 0 30px;
            border-bottom: 1px solid #e9ecef;
        }

        .nav-menu .nav-link {
            color: #4a5568;
            font-weight: 500;
            padding: 15px 20px;
            transition: all 0.3s;
            position: relative;
        }

        .nav-menu .nav-link:hover {
            color: #2c3e66;
            background: #f8f9fc;
        }

        .nav-menu .nav-link.active {
            color: #2c3e66;
            background: #eef2ff;
        }

        .nav-menu .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #2c3e66;
            border-radius: 3px 3px 0 0;
        }

        .nav-menu .nav-link i {
            margin-right: 8px;
            font-size: 16px;
        }

        .nav-menu .nav-link.text-danger {
            color: #dc3545 !important;
        }

        .nav-menu .nav-link.text-danger:hover {
            background: #fff5f5;
            color: #dc3545 !important;
        }

        /* Content Area */
        .content-wrapper {
            padding: 30px;
            min-height: calc(100vh - 140px);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s;
            background: #ffffff;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid #e9ecef;
            padding: 18px 22px;
            font-weight: 600;
            font-size: 16px;
            color: #1a1a2e;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fc;
            color: #2c3e66;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding: 12px;
        }

        .table tbody tr:hover {
            background: #f8f9fc;
        }

        /* Button Styling */
        .btn-primary {
            background: #2c3e66;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #1e2a4a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 62, 102, 0.2);
        }

        .btn-warning {
            background: #e67e22;
            border: none;
            color: white;
        }
        
        .btn-warning:hover {
            background: #d35400;
        }
        
        .btn-success {
            background: #27ae60;
            border: none;
        }
        
        .btn-success:hover {
            background: #229954;
        }
        
        .btn-danger {
            background: #e74c3c;
            border: none;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .btn-secondary {
            background: #95a5a6;
            border: none;
        }

        /* Badge */
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .bg-success {
            background: #27ae60 !important;
        }
        
        .bg-danger {
            background: #e74c3c !important;
        }
        
        .bg-warning {
            background: #f39c12 !important;
            color: #1a1a2e;
        }
        
        .bg-primary {
            background: #2c3e66 !important;
        }
        
        .bg-info {
            background: #3498db !important;
        }
        
        .bg-secondary {
            background: #7f8c8d !important;
        }

        /* Alert */
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Text colors */
        h1, h2, h3, h4, h5, h6 {
            color: #1a1a2e;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                padding: 0 15px;
            }
            .nav-menu .nav-link {
                padding: 12px 12px;
                font-size: 13px;
            }
            .content-wrapper {
                padding: 20px;
            }
            .navbar-top {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar-top d-flex justify-content-between align-items-center">
        <div class="navbar-brand">
            <i class="fas fa-boxes"></i> Inventory System
        </div>
        <div class="user-info">
            <i class="fas fa-user-circle"></i> {{ session('user')['nama_lengkap'] }} 
            <span class="badge bg-light text-dark ms-2">{{ ucfirst(session('user')['role']) }}</span>
        </div>
    </div>

    <div class="nav-menu">
        <nav class="nav">
            <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('petugas.products') ? 'active' : '' }}" href="{{ route('petugas.products') }}">
                <i class="fas fa-box"></i> Data Barang
            </a>
            <a class="nav-link {{ request()->routeIs('petugas.products.create') ? 'active' : '' }}" href="{{ route('petugas.products.create') }}">
                <i class="fas fa-plus-circle"></i> Tambah Barang
            </a>
            <a class="nav-link {{ request()->routeIs('petugas.low-stock') ? 'active' : '' }}" href="{{ route('petugas.low-stock') }}">
                <i class="fas fa-exclamation-triangle"></i> Stok Menipis
            </a>
            <a class="nav-link" href="{{ route('petugas.reports.stock') }}">
                <i class="fas fa-chart-bar"></i> Laporan Stok
            </a>
            <a class="nav-link" href="{{ route('petugas.receipts.index') }}">
                <i class="fas fa-receipt"></i> Tanda Terima
            </a>
                        <a class="nav-link text-danger" href="/logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <div class="content-wrapper">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>