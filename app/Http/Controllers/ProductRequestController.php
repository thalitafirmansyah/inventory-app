<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\StockMutation;
use Illuminate\Http\Request;

class ProductRequestController extends Controller
{
    public function index()
    {
        $requests = ProductRequest::with(['product', 'user', 'approver'])->orderBy('created_at', 'desc')->get();
        return view('admin.requests.index', compact('requests'));
    }

    public function myRequests()
    {
        $requests = ProductRequest::with('product')
            ->where('user_id', session('user')['id'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('petugas.requests.index', compact('requests'));
    }

    public function create()
    {
        $products = Product::all();
        return view('petugas.requests.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable'
        ]);

        ProductRequest::create([
            'product_id' => $request->product_id,
            'user_id' => session('user')['id'],
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'pending'
        ]);

        return redirect('/petugas/requests')->with('success', 'Pengajuan barang berhasil dikirim');
    }

    public function approve($id)
    {
        $request = ProductRequest::findOrFail($id);
        $product = $request->product;
        
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
            'keterangan' => 'Pengajuan barang disetujui: ' . ($request->keterangan ?? '')
        ]);

        $request->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => session('user')['id']
        ]);

        return back()->with('success', 'Pengajuan barang disetujui');
    }

    public function reject($id)
    {
        $request = ProductRequest::findOrFail($id);
        
        $request->update([
            'status' => 'rejected',
            'approved_at' => now(),
            'approved_by' => session('user')['id']
        ]);

        return back()->with('success', 'Pengajuan barang ditolak');
    }
}