<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        Ingredient::truncate();

        $items = [
            ['sku' => 'BHN-001', 'name' => 'Kulit Gyoza', 'category' => 'Dapur Dalam', 'stock' => 12, 'min_stock' => 5, 'unit' => 'Bungkus'],
            ['sku' => 'BHN-002', 'name' => 'Kulit Pangsit', 'category' => 'Dapur Dalam', 'stock' => 26, 'min_stock' => 5, 'unit' => 'Bungkus'],
            ['sku' => 'BHN-003', 'name' => 'Cabe Kriting', 'category' => 'Bumbu & Sayur', 'stock' => 6, 'min_stock' => 5, 'unit' => 'Bungkus'],
            ['sku' => 'BHN-004', 'name' => 'Bawang Merah', 'category' => 'Bumbu & Sayur', 'stock' => 0, 'min_stock' => 10, 'unit' => 'Buah'],
            ['sku' => 'BHN-005', 'name' => 'Bawang Putih', 'category' => 'Bumbu & Sayur', 'stock' => 30, 'min_stock' => 10, 'unit' => 'Buah'],
            ['sku' => 'BHN-006', 'name' => 'Bawang Bombay', 'category' => 'Bumbu & Sayur', 'stock' => 8, 'min_stock' => 5, 'unit' => 'Buah'],
            ['sku' => 'BHN-007', 'name' => 'Bawang Pre', 'category' => 'Bumbu & Sayur', 'stock' => 4, 'min_stock' => 5, 'unit' => 'Ikat'],
            ['sku' => 'BHN-008', 'name' => 'Tepung Sagu', 'category' => 'Dapur Dalam', 'stock' => 10, 'min_stock' => 3, 'unit' => 'Bungkus'],
            ['sku' => 'BHN-009', 'name' => 'Mie Basah Kuah Kuwi', 'category' => 'Dapur Dalam', 'stock' => 45, 'min_stock' => 15, 'unit' => 'Porsi'],
            ['sku' => 'BHN-010', 'name' => 'Daging Ayam Giling', 'category' => 'Frozen & Olahan', 'stock' => 3, 'min_stock' => 5, 'unit' => 'Kg'],
        ];

        foreach ($items as $item) {
            Ingredient::create($item);
        }
    }
}