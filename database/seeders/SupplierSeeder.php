<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'kode_supplier' => 'SUP0001',
                'nama_supplier' => 'PT. Elektronik Jaya',
                'kontak' => '081234567890',
                'alamat' => 'Jl. Raya Elektronik No. 123, Jakarta'
            ],
            [
                'kode_supplier' => 'SUP0002',
                'nama_supplier' => 'CV. Sumber Makmur',
                'kontak' => '081298765432',
                'alamat' => 'Jl. Industri Raya No. 45, Surabaya'
            ],
            [
                'kode_supplier' => 'SUP0003',
                'nama_supplier' => 'UD. Berkah Abadi',
                'kontak' => '082112345678',
                'alamat' => 'Jl. Pahlawan No. 78, Bandung'
            ],
            [
                'kode_supplier' => 'SUP0004',
                'nama_supplier' => 'PT. Food Station',
                'kontak' => '081376543210',
                'alamat' => 'Jl. Kuliner No. 9, Semarang'
            ],
            [
                'kode_supplier' => 'SUP0005',
                'nama_supplier' => 'CV. Fashion Trend',
                'kontak' => '085212345678',
                'alamat' => 'Jl. Mode No. 23, Yogyakarta'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}