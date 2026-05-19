<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'stok', 'stok_minimum', 
        'satuan', 'harga_beli', 'harga_jual', 'gambar', 
        'supplier_id', 'rack_id', 'deskripsi'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }

    // Relasi ke StockMutation
    public function stockMutations()
    {
        return $this->hasMany(StockMutation::class)->orderBy('created_at', 'desc');
    }

    // Hitung total stok masuk
    public function getTotalStokMasukAttribute()
    {
        return $this->stockMutations()->masuk()->sum('jumlah');
    }

    // Hitung total stok keluar
    public function getTotalStokKeluarAttribute()
    {
        return $this->stockMutations()->keluar()->sum('jumlah');
    }

    // Cek apakah stok menipis
    public function getIsLowStockAttribute()
    {
        return $this->stok <= $this->stok_minimum;
    }

    // Dapatkan status stok
    public function getStockStatusAttribute()
    {
        if ($this->stok <= 0) {
            return ['text' => 'Habis', 'class' => 'danger'];
        } elseif ($this->stok <= $this->stok_minimum) {
            return ['text' => 'Menipis', 'class' => 'warning'];
        } else {
            return ['text' => 'Tersedia', 'class' => 'success'];
        }
    }
}