<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'price', 'subtotal'];

    // Setiap detail pesanan merujuk ke satu menu/produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}