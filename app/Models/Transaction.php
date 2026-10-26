<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'receipt_number', 'total_amount', 'note'];

    // Satu transaksi memiliki banyak detail item
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Transaksi ini dilayani oleh satu kasir (User)
    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}