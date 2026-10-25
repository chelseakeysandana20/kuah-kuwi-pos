<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'description', 'price', 'image', 'is_available'
    ];

    // Satu produk hanya milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}