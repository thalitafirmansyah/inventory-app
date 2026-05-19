<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'kontak' => 'required',
            'alamat' => 'required'
        ]);

        $lastSupplier = Supplier::latest('id')->first();
        $newNumber = $lastSupplier ? intval(substr($lastSupplier->kode_supplier, 3)) + 1 : 1;
        $kodeSupplier = 'SUP' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Supplier::create([
            'kode_supplier' => $kodeSupplier,
            'nama_supplier' => $request->nama_supplier,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat
        ]);

        return redirect('/admin/suppliers')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        
        $request->validate([
            'nama_supplier' => 'required',
            'kontak' => 'required',
            'alamat' => 'required'
        ]);

        $supplier->update($request->all());
        
        return redirect('/admin/suppliers')->with('success', 'Supplier berhasil diupdate');
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return redirect('/admin/suppliers')->with('success', 'Supplier berhasil dihapus');
    }
}