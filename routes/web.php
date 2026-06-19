<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PetugasController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// ADMIN ROUTES
Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('/products', ProductController::class);
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/top-stock', [ReportController::class, 'topStock'])->name('top-stock');
        Route::get('/low-stock', [ReportController::class, 'lowStock'])->name('low-stock');
    });
});

// PETUGAS ROUTES (SEMUA DALAM SATU GROUP)
Route::prefix('petugas')->middleware(['role:petugas'])->name('petugas.')->group(function () {
    // Dashboard & Barang
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [PetugasController::class, 'products'])->name('products');
    Route::get('/products/create', [PetugasController::class, 'create'])->name('products.create');
    Route::post('/products', [PetugasController::class, 'store'])->name('products.store');
    Route::post('/products/{id}/stock-in', [PetugasController::class, 'stockIn'])->name('stock.in');
    Route::post('/products/{id}/stock-out', [PetugasController::class, 'stockOut'])->name('stock.out');
    Route::get('/low-stock', [PetugasController::class, 'lowStock'])->name('low-stock');
    
    // Laporan Stok
    Route::get('/reports/stock', [ReportController::class, 'stockReport'])->name('reports.stock');
    
    // Tanda Terima
    Route::get('/receipts', [ReportController::class, 'receiptIndex'])->name('receipts.index');
    Route::get('/receipts/create', [ReportController::class, 'receiptCreate'])->name('receipts.create');
    Route::post('/receipts', [ReportController::class, 'receiptStore'])->name('receipts.store');
    Route::get('/receipts/{id}', [ReportController::class, 'receiptShow'])->name('receipts.show');
    Route::get('/receipts/{id}/print', [ReportController::class, 'receiptPrint'])->name('receipts.print');
});

// HALAMAN AWAL (LANDING PAGE)
Route::get('/', function () {
    if (session()->has('user')) {
        $role = session('user')['role'];
        if ($role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/petugas/dashboard');
        }
    }
    return view('welcome');
});