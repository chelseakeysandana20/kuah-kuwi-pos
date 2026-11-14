<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'category',
        'stock',
        'min_stock',
        'unit',
    ];

    // Otomatis menentukan status stok: 'habis', 'perlu_belanja', atau 'aman'
    public function getStatusAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'habis';
        }
        if ($this->stock <= $this->min_stock) {
            return 'perlu_belanja';
        }
        return 'aman';
    }
}