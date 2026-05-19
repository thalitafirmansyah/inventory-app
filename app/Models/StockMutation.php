<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMutation extends Model
{
    protected $table = 'stock_mutations';
    
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'keterangan'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'jumlah' => 'integer',
        'stok_sebelum' => 'integer',
        'stok_sesudah' => 'integer'
    ];

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi ke User (petugas/admin yang melakukan mutasi)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessor untuk menampilkan tipe dengan icon
    public function getTypeIconAttribute()
    {
        if ($this->type == 'in') {
            return '<span class="badge bg-success"><i class="bi bi-arrow-down"></i> Masuk (+)</span>';
        } else {
            return '<span class="badge bg-danger"><i class="bi bi-arrow-up"></i> Keluar (-)</span>';
        }
    }

    // Accessor untuk format jumlah
    public function getFormattedJumlahAttribute()
    {
        return number_format($this->jumlah) . ' ' . ($this->product ? $this->product->satuan : '');
    }

    // Scope untuk filter tipe tertentu
    public function scopeMasuk($query)
    {
        return $query->where('type', 'in');
    }

    public function scopeKeluar($query)
    {
        return $query->where('type', 'out');
    }

    // Scope untuk filter tanggal
    public function scopeHariIni($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('created_at', now()->month)
                     ->whereYear('created_at', now()->year);
    }
}