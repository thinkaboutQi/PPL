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
        Schema::create('tokos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('alamat');
            $table->foreignId('provinsi_id')->constrained('provinsis')->onDelete('cascade');
            $table->foreignId('kabupaten_id')->constrained('kabupatens')->onDelete('cascade');
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');
            $table->string('telepon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokos');
    }
};
