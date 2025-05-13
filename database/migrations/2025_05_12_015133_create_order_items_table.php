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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Menghubungkan ke tabel orders
            $table->foreignId('produk_air_id')->constrained('produk_airs')->onDelete('cascade'); // Menghubungkan ke tabel produk_airs
            $table->integer('quantity'); // Jumlah produk
            $table->decimal('harga_satuan', 15, 2); // Harga per unit produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
