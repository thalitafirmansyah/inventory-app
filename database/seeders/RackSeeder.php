<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rack;

class RackSeeder extends Seeder
{
    public function run()
    {
        $racks = [
            [
                'kode_rak' => 'RAK0001',
                'nama_rak' => 'Rak Elektronik A1',
                'lokasi' => 'Gudang Utama - Lantai 1, Blok A'
            ],
            [
                'kode_rak' => 'RAK0002',
                'nama_rak' => 'Rak Elektronik A2',
                'lokasi' => 'Gudang Utama - Lantai 1, Blok A'
            ],
            [
                'kode_rak' => 'RAK0003',
                'nama_rak' => 'Rak Makanan B1',
                'lokasi' => 'Gudang Utama - Lantai 2, Blok B'
            ],
            [
                'kode_rak' => 'RAK0004',
                'nama_rak' => 'Rak Minuman B2',
                'lokasi' => 'Gudang Utama - Lantai 2, Blok B'
            ],
            [
                'kode_rak' => 'RAK0005',
                'nama_rak' => 'Rak Fashion C1',
                'lokasi' => 'Gudang Sekunder - Lantai 1, Blok C'
            ],
            [
                'kode_rak' => 'RAK0006',
                'nama_rak' => 'Rak Aksesoris C2',
                'lokasi' => 'Gudang Sekunder - Lantai 1, Blok C'
            ]
        ];

        foreach ($racks as $rack) {
            Rack::create($rack);
        }
    }
}