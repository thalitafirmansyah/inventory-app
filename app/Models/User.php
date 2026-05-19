<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username', 'password', 'role', 'nama_lengkap'
    ];

    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }

    public function approvedRequests()
    {
        return $this->hasMany(ProductRequest::class, 'approved_by');
    }

    // Relasi ke StockMutation
    public function stockMutations()
    {
        return $this->hasMany(StockMutation::class)->orderBy('created_at', 'desc');
    }

    // Hitung total mutasi yang dilakukan user
    public function getTotalMutationsAttribute()
    {
        return $this->stockMutations()->count();
    }

    // Hitung total stok yang ditambahkan user
    public function getTotalStockAddedAttribute()
    {
        return $this->stockMutations()->masuk()->sum('jumlah');
    }
}