<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Data Kategori
        $makanan = Category::create([
            'name' => 'Makanan Utama',
            'description' => 'Aneka menu makanan berat dan berkuah'
        ]);

        $minuman = Category::create([
            'name' => 'Minuman',
            'description' => 'Aneka minuman dingin dan panas'
        ]);

        $snack = Category::create([
            'name' => 'Snack & Topping',
            'description' => 'Camilan dan tambahan pesanan'
        ]);

        // 2. Buat Data Produk (Menu Kuah Kuwi)
        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Bakso Kuah Pedas',
            'description' => 'Bakso sapi dengan siraman kuah pedas gurih khas',
            'price' => 15000,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Seblak Kuah Kuwi',
            'description' => 'Seblak komplit isian sosis, telur, dan kerupuk',
            'price' => 18000,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Es Teh Manis',
            'description' => 'Es teh kental manis segar',
            'price' => 5000,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Es Jeruk Peras',
            'description' => 'Perasan jeruk asli dengan es batu',
            'price' => 7000,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $snack->id,
            'name' => 'Tahu Walik Goreng',
            'description' => 'Tahu walik renyah isi ayam (isi 5)',
            'price' => 12000,
            'is_available' => true,
        ]);
    }
}