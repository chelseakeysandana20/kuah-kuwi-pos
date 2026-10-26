<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
        {
            Schema::table('transactions', function (Blueprint $table) {
                // Menambahkan kolom note bertipe text yang boleh kosong (nullable)
                // after() digunakan agar posisinya rapi setelah kolom total_amount
                $table->text('note')->nullable()->after('total_amount');
            });
        }

    public function down()
        {
            Schema::table('transactions', function (Blueprint $table) {
                // Menghapus kolom jika kita melakukan rollback
                $table->dropColumn('note');
            });
        }
};
