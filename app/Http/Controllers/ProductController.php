<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Rack;
use App\Models\StockMutation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with(['supplier', 'rack']);
    
    // Fitur pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_barang', 'like', "%{$search}%")
              ->orWhere('kode_barang', 'like', "%{$search}%");
        });
    }
    
    $products = $query->get();
    return view('admin.products.index', compact('products'));
}
    public function create()
    {
        $suppliers = Supplier::all();
        $racks = Rack::all();
        return view('admin.products.create', compact('suppliers', 'racks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'supplier_id' => 'required',
            'rack_id' => 'required',
            'stok_minimum' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/products'), $gambarName);
        }

        $lastProduct = Product::latest('id')->first();
        $newNumber = $lastProduct ? intval(substr($lastProduct->kode_barang, 3)) + 1 : 1;
        $kodeBarang = 'BRG' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Product::create([
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'stok' => 0,
            'stok_minimum' => $request->stok_minimum,
            'satuan' => $request->satuan,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'gambar' => $gambarName,
            'supplier_id' => $request->supplier_id,
            'rack_id' => $request->rack_id
        ]);

        return redirect('/admin/products')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $racks = Rack::all();
        return view('admin.products.edit', compact('product', 'suppliers', 'racks'));
    }

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'satuan' => 'required|string|max:50',
        'harga_beli' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Upload gambar baru jika ada
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama
        if ($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar))) {
            unlink(public_path('uploads/products/' . $product->gambar));
        }
        
        $gambarName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $request->file('gambar')->getClientOriginalName());
        $request->file('gambar')->move(public_path('uploads/products'), $gambarName);
        $product->gambar = $gambarName;
    }

    // Update data barang
    $product->update([
        'nama_barang' => $request->nama_barang,
        'stok' => $request->stok,
        'satuan' => $request->satuan,
        'harga_beli' => $request->harga_beli,
        'harga_jual' => $request->harga_beli + ($request->harga_beli * 0.2),
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Barang berhasil diupdate!');
}
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar))) {
            unlink(public_path('uploads/products/' . $product->gambar));
        }
        
        $product->delete();
        
        return redirect('/admin/products')->with('success', 'Barang berhasil dihapus');
    }
}