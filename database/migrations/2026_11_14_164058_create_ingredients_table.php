<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->nullable();
            $table->string('name');
            $table->string('category')->default('Dapur Dalam');
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(5); // Batas minimum sebelum status jadi "Perlu Belanja"
            $table->string('unit')->default('Bungkus'); // Bungkus, Buah, Kg, Liter, Pcs
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};