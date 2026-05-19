<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'username' => 'admin',
            'password' => md5('admin123'),
            'role' => 'admin',
            'nama_lengkap' => 'Administrator'
        ]);

        // Petugas
        User::create([
            'username' => 'petugas',
            'password' => md5('petugas123'),
            'role' => 'petugas',
            'nama_lengkap' => 'Petugas Gudang'
        ]);
    }
}