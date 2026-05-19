<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Rack;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Ambil data supplier dan rack yang sudah ada
        $supplierElektronik = Supplier::where('nama_supplier', 'LIKE', '%Elektronik%')->first();
        $supplierMakanan = Supplier::where('nama_supplier', 'LIKE', '%Food%')->first();
        $supplierFashion = Supplier::where('nama_supplier', 'LIKE', '%Fashion%')->first();
        
        $rakElektronik = Rack::where('kode_rak', 'RAK0001')->first();
        $rakMakanan = Rack::where('kode_rak', 'RAK0003')->first();
        $rakFashion = Rack::where('kode_rak', 'RAK0005')->first();

        $products = [
            // Produk Elektronik
            [
                'kode_barang' => 'BRG0001',
                'nama_barang' => 'Smartphone Samsung A54',
                'stok' => 50,
                'stok_minimum' => 10,
                'satuan' => 'Unit',
                'harga_beli' => 3500000,
                'harga_jual' => 4200000,
                'gambar' => null,
                'supplier_id' => $supplierElektronik?->id,
                'rack_id' => $rakElektronik?->id,
                'deskripsi' => 'Smartphone 5G dengan kamera 50MP, RAM 8GB, Storage 128GB'
            ],
            [
                'kode_barang' => 'BRG0002',
                'nama_barang' => 'Laptop ASUS ROG',
                'stok' => 25,
                'stok_minimum' => 5,
                'satuan' => 'Unit',
                'harga_beli' => 12500000,
                'harga_jual' => 14999000,
                'gambar' => null,
                'supplier_id' => $supplierElektronik?->id,
                'rack_id' => $rakElektronik?->id,
                'deskripsi' => 'Laptop Gaming dengan prosesor Intel i7, RAM 16GB, SSD 512GB'
            ],
            [
                'kode_barang' => 'BRG0003',
                'nama_barang' => 'Headphone Bluetooth Sony',
                'stok' => 100,
                'stok_minimum' => 20,
                'satuan' => 'Unit',
                'harga_beli' => 750000,
                'harga_jual' => 950000,
                'gambar' => null,
                'supplier_id' => $supplierElektronik?->id,
                'rack_id' => $rakElektronik?->id,
                'deskripsi' => 'Headphone nirkabel dengan noise cancellation, battery life 30 jam'
            ],
            
            // Produk Makanan
            [
                'kode_barang' => 'BRG0004',
                'nama_barang' => 'Indomie Goreng',
                'stok' => 500,
                'stok_minimum' => 100,
                'satuan' => 'Dus',
                'harga_beli' => 85000,
                'harga_jual' => 95000,
                'gambar' => null,
                'supplier_id' => $supplierMakanan?->id,
                'rack_id' => $rakMakanan?->id,
                'deskripsi' => 'Indomie Goreng 1 dus isi 40 bungkus'
            ],
            [
                'kode_barang' => 'BRG0005',
                'nama_barang' => 'Aqua 600ml',
                'stok' => 300,
                'stok_minimum' => 50,
                'satuan' => 'Karton',
                'harga_beli' => 35000,
                'harga_jual' => 42000,
                'gambar' => null,
                'supplier_id' => $supplierMakanan?->id,
                'rack_id' => $rakMakanan?->id,
                'deskripsi' => 'Air mineral Aqua 600ml, 1 karton isi 24 botol'
            ],
            [
                'kode_barang' => 'BRG0006',
                'nama_barang' => 'Oreo Original',
                'stok' => 200,
                'stok_minimum' => 30,
                'satuan' => 'Pack',
                'harga_beli' => 6500,
                'harga_jual' => 8500,
                'gambar' => null,
                'supplier_id' => $supplierMakanan?->id,
                'rack_id' => $rakMakanan?->id,
                'deskripsi' => 'Biskuit coklat Oreo 133 gram'
            ],
            
            // Produk Fashion
            [
                'kode_barang' => 'BRG0007',
                'nama_barang' => 'Kaos Polos Pria',
                'stok' => 150,
                'stok_minimum' => 25,
                'satuan' => 'Pcs',
                'harga_beli' => 45000,
                'harga_jual' => 65000,
                'gambar' => null,
                'supplier_id' => $supplierFashion?->id,
                'rack_id' => $rakFashion?->id,
                'deskripsi' => 'Kaos polos pria bahan cotton combed 30s, tersedia berbagai warna'
            ],
            [
                'kode_barang' => 'BRG0008',
                'nama_barang' => 'Jeans Pria',
                'stok' => 80,
                'stok_minimum' => 15,
                'satuan' => 'Pcs',
                'harga_beli' => 125000,
                'harga_jual' => 185000,
                'gambar' => null,
                'supplier_id' => $supplierFashion?->id,
                'rack_id' => $rakFashion?->id,
                'deskripsi' => 'Celana jeans pria bahan denim, size 28-36'
            ],
            [
                'kode_barang' => 'BRG0009',
                'nama_barang' => 'Jaket Hoodie',
                'stok' => 40,
                'stok_minimum' => 10,
                'satuan' => 'Pcs',
                'harga_beli' => 95000,
                'harga_jual' => 145000,
                'gambar' => null,
                'supplier_id' => $supplierFashion?->id,
                'rack_id' => $rakFashion?->id,
                'deskripsi' => 'Jaket hoodie dengan bahan fleece, tersedia size S-XXL'
            ],
            
            // Produk dengan stok menipis (untuk testing)
            [
                'kode_barang' => 'BRG0010',
                'nama_barang' => 'Power Bank 10000mAh',
                'stok' => 3,
                'stok_minimum' => 10,
                'satuan' => 'Unit',
                'harga_beli' => 120000,
                'harga_jual' => 175000,
                'gambar' => null,
                'supplier_id' => $supplierElektronik?->id,
                'rack_id' => $rakElektronik?->id,
                'deskripsi' => 'Power bank kapasitas 10000mAh dengan fast charging'
            ],
            [
                'kode_barang' => 'BRG0011',
                'nama_barang' => 'Mouse Wireless Logitech',
                'stok' => 5,
                'stok_minimum' => 15,
                'satuan' => 'Unit',
                'harga_beli' => 85000,
                'harga_jual' => 125000,
                'gambar' => null,
                'supplier_id' => $supplierElektronik?->id,
                'rack_id' => $rakElektronik?->id,
                'deskripsi' => 'Mouse wireless Logitech M185'
            ]
        ];

        foreach ($products as $product) {
            // Skip jika supplier_id atau rack_id null
            if ($product['supplier_id'] && $product['rack_id']) {
                Product::create($product);
            }
        }
    }
}