<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockMutation;
use App\Models\Product;
use App\Models\User;

class StockMutationSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $admin = User::where('role', 'admin')->first();
        $petugas = User::where('role', 'petugas')->first();

        // Data contoh mutasi stok
        $mutations = [
            [
                'product_id' => $products->first()?->id,
                'user_id' => $admin?->id,
                'type' => 'in',
                'jumlah' => 100,
                'stok_sebelum' => 0,
                'stok_sesudah' => 100,
                'keterangan' => 'Initial stock by admin',
                'created_at' => now()->subDays(30),
            ],
            [
                'product_id' => $products->first()?->id,
                'user_id' => $petugas?->id,
                'type' => 'in',
                'jumlah' => 50,
                'stok_sebelum' => 100,
                'stok_sesudah' => 150,
                'keterangan' => 'Restock from supplier',
                'created_at' => now()->subDays(15),
            ],
        ];

        foreach ($mutations as $mutation) {
            if ($mutation['product_id'] && $mutation['user_id']) {
                StockMutation::create($mutation);
            }
        }
    }
}