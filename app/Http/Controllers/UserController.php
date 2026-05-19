<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'nama_lengkap' => 'required',
            'role' => 'required|in:admin,petugas',
            'password' => 'required|min:4'
        ]);

        User::create([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
            'password' => md5($request->password) // MD5 hash
        ]);

        return redirect('/admin/users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'nama_lengkap' => 'required',
            'role' => 'required|in:admin,petugas'
        ]);

        $data = [
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = md5($request->password);
        }

        $user->update($data);
        
        return redirect('/admin/users')->with('success', 'Pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Cegah menghapus diri sendiri
        if ($user->id == session('user')['id']) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }
        
        $user->delete();
        return redirect('/admin/users')->with('success', 'Pengguna berhasil dihapus');
    }
}