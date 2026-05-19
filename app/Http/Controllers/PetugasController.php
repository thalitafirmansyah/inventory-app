<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMutation;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalStok = Product::sum('stok');
        $lowStockProducts = Product::where('stok', '<=', 5)->orderBy('stok', 'asc')->get();
        $lowStockCount = $lowStockProducts->count();

        $stockInLast30 = StockMutation::where('type', 'in')
            ->where('created_at', '>=', now()->subDays(30))
            ->sum('jumlah');

        $stockOutLast30 = StockMutation::where('type', 'out')
            ->where('created_at', '>=', now()->subDays(30))
            ->sum('jumlah');

        $stockInDetails = StockMutation::with(['product', 'user'])
            ->where('type', 'in')
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->get();

        $stockOutDetails = StockMutation::with(['product', 'user'])
            ->where('type', 'out')
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->get();

        $topStockProducts = Product::orderBy('stok', 'desc')->take(5)->get();

        return view('petugas.dashboard', [
            'totalProducts' => $totalProducts,
            'totalStok' => $totalStok,
            'lowStockProducts' => $lowStockProducts,
            'lowStockCount' => $lowStockCount,
            'stockInLast30' => $stockInLast30,
            'stockOutLast30' => $stockOutLast30,
            'topStockProducts' => $topStockProducts,
            'stockInDetails' => $stockInDetails,
            'stockOutDetails' => $stockOutDetails
        ]);
    }

    public function products(Request $request)
    {
        $query = Product::orderBy('created_at', 'desc');

        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        $products = $query->get();
        return view('petugas.products.index', compact('products'));
    }

    public function create()
    {
        return view('petugas.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $uploadPath = public_path('uploads/products');
        if (!file_exists($uploadPath)) mkdir($uploadPath, 0777, true);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move($uploadPath, $gambarName);
        }

        $lastProduct = Product::latest('id')->first();
        $lastNumber = $lastProduct ? intval(substr($lastProduct->kode_barang, 3)) : 0;
        $kodeBarang = 'BRG' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $hargaJual = $request->harga_beli + ($request->harga_beli * 0.2);

        Product::create([
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'stok_minimum' => 5,
            'satuan' => $request->satuan,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $hargaJual,
            'gambar' => $gambarName,
            'supplier_id' => 1,
            'rack_id' => 1,
            'deskripsi' => null
        ]);

        return redirect()->route('petugas.products')->with('success', 'Barang berhasil ditambahkan');
    }

    // ========== STOCK IN (BARANG MASUK) ==========
    public function stockIn(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $stokSebelum = $product->stok;
        $product->stok += $request->jumlah;
        $product->save();

        StockMutation::create([
            'product_id' => $product->id,
            'user_id' => session('user')['id'],
            'type' => 'in',
            'jumlah' => $request->jumlah,
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $product->stok,
            'keterangan' => $request->keterangan ?? 'Barang masuk'
        ]);

        return redirect()->route('petugas.products')->with('success', 'Stok berhasil ditambahkan');
    }

    // ========== STOCK OUT (BARANG KELUAR) ==========
    public function stockOut(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        // Cek apakah stok cukup
        if ($product->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi! Stok saat ini: ' . $product->stok);
        }

        $stokSebelum = $product->stok;
        $product->stok -= $request->jumlah;
        $product->save();

        StockMutation::create([
            'product_id' => $product->id,
            'user_id' => session('user')['id'],
            'type' => 'out',
            'jumlah' => $request->jumlah,
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $product->stok,
            'keterangan' => $request->keterangan ?? 'Barang keluar'
        ]);

        return redirect()->route('petugas.products')->with('success', 'Stok berhasil dikurangi');
    }

    // ========== LOW STOCK ==========
    public function lowStock()
    {
        $lowStockProducts = Product::where('stok', '<=', 5)
            ->orderBy('stok', 'asc')
            ->get();

        return view('petugas.low_stock', compact('lowStockProducts'));
    }
}