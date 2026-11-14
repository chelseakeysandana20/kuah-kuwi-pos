<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan data dummy lama dengan aman
        Schema::disableForeignKeyConstraints();
        TransactionDetail::truncate();
        Transaction::truncate();
        Product::truncate();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Buat 3 Kategori Utama Kuah Kuwi
        $noodle = Category::create([
            'id'          => 1,
            'name'        => 'Noodle',
            'description' => 'Aneka mie, bakmi, add-on, dan snack Kuah Kuwi',
        ]);

        $gyoza = Category::create([
            'id'          => 2,
            'name'        => 'Gyoza',
            'description' => 'Aneka gyoza goreng, rebus, panggang, dan kuah',
        ]);

        $drink = Category::create([
            'id'          => 3,
            'name'        => 'Drink',
            'description' => 'Aneka minuman segar Kuah Kuwi',
        ]);

        // 3. Daftar Seluruh Menu Asli Kuah Kuwi
        $menus = [
            // === NOODLE (Termasuk Add-On & Snack -> $noodle->id) ===
            ['category_id' => $noodle->id, 'name' => 'Mie Jebew', 'price' => 11000],
            ['category_id' => $noodle->id, 'name' => 'Mie Gurih', 'price' => 11000],
            ['category_id' => $noodle->id, 'name' => 'Bakmi Polos', 'price' => 10000],
            ['category_id' => $noodle->id, 'name' => 'Bakmi Original', 'price' => 14000],
            ['category_id' => $noodle->id, 'name' => 'Bakmi Ayam Panggang', 'price' => 18000],
            ['category_id' => $noodle->id, 'name' => 'Bakmi Latte', 'price' => 21000],
            ['category_id' => $noodle->id, 'name' => 'Bakmi Laksa', 'price' => 21000],
            ['category_id' => $noodle->id, 'name' => 'Bakar Keju', 'price' => 5000],
            ['category_id' => $noodle->id, 'name' => 'Sosis Jumbo Goreng/Rebus (AddOn)', 'price' => 5000],
            ['category_id' => $noodle->id, 'name' => 'Gyoza Rebus/Goreng (AddOn)', 'price' => 3000],
            ['category_id' => $noodle->id, 'name' => 'Mie Jebew lvl 1-3 (AddOn)', 'price' => 0],
            ['category_id' => $noodle->id, 'name' => 'Mie Jebew lvl 4-6 (AddOn)', 'price' => 1000],
            ['category_id' => $noodle->id, 'name' => 'Chili Oil (AddOn)', 'price' => 3000],
            ['category_id' => $noodle->id, 'name' => 'Cireng Kuah Keju', 'price' => 11000],
            ['category_id' => $noodle->id, 'name' => 'Kentang Mentai', 'price' => 12000],

            // === GYOZA ($gyoza->id) ===
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Goreng', 'price' => 14000],
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Panggang', 'price' => 14000],
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Pedas (goreng/rebus)', 'price' => 16000],
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Kuah (ori/pedas/laksa)', 'price' => 16000],
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Mentai', 'price' => 16000],
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Kuah Keju (goreng/rebus)', 'price' => 16000],
            ['category_id' => $gyoza->id, 'name' => 'Gyoza Mix', 'price' => 25000],

            // === DRINK ($drink->id) ===
            ['category_id' => $drink->id, 'name' => 'Es Batu', 'price' => 1000],
            ['category_id' => $drink->id, 'name' => 'Air Mineral', 'price' => 4000],
            ['category_id' => $drink->id, 'name' => 'Jasmine Tea', 'price' => 5000],
            ['category_id' => $drink->id, 'name' => 'Lemon Tea', 'price' => 7000],
            ['category_id' => $drink->id, 'name' => 'Lychee Tea', 'price' => 7000],
            ['category_id' => $drink->id, 'name' => 'Matcha', 'price' => 10000],
            ['category_id' => $drink->id, 'name' => 'Thai Tea', 'price' => 10000],
        ];

        // 4. Masukkan semua menu ke database
        foreach ($menus as $menu) {
            Product::create([
                'category_id'  => $menu['category_id'],
                'name'         => $menu['name'],
                'description'  => 'Menu Kuah Kuwi',
                'price'        => $menu['price'],
                'is_available' => true,
            ]);
        }
    }
}