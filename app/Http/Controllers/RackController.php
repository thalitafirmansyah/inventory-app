<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index()
    {
        $racks = Rack::all();
        return view('admin.racks.index', compact('racks'));
    }

    public function create()
    {
        return view('admin.racks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required'
        ]);

        $lastRack = Rack::latest('id')->first();
        $newNumber = $lastRack ? intval(substr($lastRack->kode_rak, 3)) + 1 : 1;
        $kodeRak = 'RAK' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Rack::create([
            'kode_rak' => $kodeRak,
            'nama_rak' => $request->nama_rak,
            'lokasi' => $request->lokasi
        ]);

        return redirect('/admin/racks')->with('success', 'Rak berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rack = Rack::findOrFail($id);
        return view('admin.racks.edit', compact('rack'));
    }

    public function update(Request $request, $id)
    {
        $rack = Rack::findOrFail($id);
        
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required'
        ]);

        $rack->update($request->all());
        
        return redirect('/admin/racks')->with('success', 'Rak berhasil diupdate');
    }

    public function destroy($id)
    {
        Rack::findOrFail($id)->delete();
        return redirect('/admin/racks')->with('success', 'Rak berhasil dihapus');
    }
}