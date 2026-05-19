<?php
// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Receipt;
use App\Models\StockMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Halaman Report Barang Masuk & Keluar (Petugas)
    public function stockReport(Request $request)
    {
        $query = StockMutation::with(['product', 'user'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter berdasarkan tipe
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        $stockMutations = $query->paginate(20);
        
        return view('petugas.reports.stock', compact('stockMutations'));
    }

    // Halaman Tanda Terima Barang (Petugas)
    public function receiptIndex()
    {
        $receipts = Receipt::with(['product', 'creator'])->orderBy('created_at', 'desc')->paginate(15);
        return view('petugas.receipts.index', compact('receipts'));
    }

    public function receiptCreate()
    {
        $products = Product::all();
        return view('petugas.receipts.create', compact('products'));
    }

    public function receiptStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'tujuan' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        // Cek stok jika barang keluar
        $product = Product::findOrFail($request->product_id);
        if ($request->type == 'out' && $product->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi! Stok saat ini: ' . $product->stok);
        }

        // Generate nomor tanda terima
        $lastReceipt = Receipt::latest('id')->first();
        $newNumber = $lastReceipt ? intval(substr($lastReceipt->no_receipt, -4)) + 1 : 1;
        $noReceipt = 'TRM' . date('Ymd') . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // Update stok
        $stokSebelum = $product->stok;
        if ($request->type == 'in') {
            $product->stok += $request->jumlah;
        } else {
            $product->stok -= $request->jumlah;
        }
        $product->save();

        // Catat mutasi stok
        StockMutation::create([
            'product_id' => $product->id,
            'user_id' => session('user')['id'],
            'type' => $request->type,
            'jumlah' => $request->jumlah,
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $product->stok,
            'keterangan' => $request->keterangan . ' (Tanda Terima: ' . $noReceipt . ')'
        ]);

        // Simpan tanda terima
        Receipt::create([
            'no_receipt' => $noReceipt,
            'product_id' => $request->product_id,
            'type' => $request->type,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'tujuan' => $request->tujuan,
            'penerima' => $request->penerima,
            'keterangan' => $request->keterangan,
            'ttd' => null,
            'created_by' => session('user')['id']
        ]);

        return redirect()->route('petugas.receipts.index')->with('success', 'Tanda terima berhasil dibuat!');
    }

    public function receiptShow($id)
    {
        $receipt = Receipt::with(['product', 'creator'])->findOrFail($id);
        return view('petugas.receipts.show', compact('receipt'));
    }

    public function receiptPrint($id)
    {
        $receipt = Receipt::with(['product', 'creator'])->findOrFail($id);
        return view('petugas.receipts.print', compact('receipt'));
    }

    // ========== TOP 5 STOK (UNTUK ADMIN) ==========
    public function topStock()
    {
        $topStockProducts = Product::orderBy('stok', 'desc')->take(5)->get();
        return view('admin.reports.top-stock', compact('topStockProducts'));
    }

    // ========== STOK MENIPIS (UNTUK ADMIN) ==========
    public function lowStock()
    {
        $lowStockProducts = Product::where('stok', '<=', 5)
            ->orderBy('stok', 'asc')
            ->get();
        return view('admin.reports.low-stock', compact('lowStockProducts'));
    }
}