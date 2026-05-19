<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMutation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalProducts = Product::count();
        $totalStok = Product::sum('stok');
        $totalValue = Product::sum(DB::raw('stok * harga_beli'));
        $recentProducts = Product::latest()->take(8)->get();
        $allProducts = Product::orderBy('nama_barang', 'asc')->get();
        
        $activityLogs = StockMutation::with(['product', 'user'])
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        
        $totalStockIn = StockMutation::where('type', 'in')->count();
        $totalStockOut = StockMutation::where('type', 'out')->count();
        $totalPetugasActions = StockMutation::count();
        
        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalStok' => $totalStok,
            'totalValue' => $totalValue,
            'recentProducts' => $recentProducts,
            'allProducts' => $allProducts,
            'activityLogs' => $activityLogs,
            'totalStockIn' => $totalStockIn,
            'totalStockOut' => $totalStockOut,
            'totalPetugasActions' => $totalPetugasActions
        ]);
    }
}