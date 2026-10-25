<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel categories
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->string('name'); // Nama menu
            $table->text('description')->nullable();
            $table->integer('price'); // Harga menggunakan integer untuk Rupiah tanpa desimal
            $table->string('image')->nullable(); // Link/path gambar menu
            $table->boolean('is_available')->default(true); // Status menu tersedia/habis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
