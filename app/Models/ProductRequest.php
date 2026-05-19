<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'jumlah', 'status', 
        'keterangan', 'approved_at', 'approved_by'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}