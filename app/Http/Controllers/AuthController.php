<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && md5($request->password) === $user->password) {
            session(['user' => [
                'id' => $user->id,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap,
                'role' => $user->role
            ]]);

            if ($user->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/petugas/dashboard');
            }
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }
}