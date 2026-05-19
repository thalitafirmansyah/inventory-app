<?php
// app/Models/Receipt.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'no_receipt', 'product_id', 'type', 'jumlah', 'tanggal',
        'tujuan', 'penerima', 'keterangan', 'ttd', 'created_by'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}