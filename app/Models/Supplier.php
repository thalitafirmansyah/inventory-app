<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['kode_supplier', 'nama_supplier', 'kontak', 'alamat'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}