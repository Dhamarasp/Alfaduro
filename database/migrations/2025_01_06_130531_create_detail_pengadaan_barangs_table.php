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
        Schema::create('detail_pengadaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengadaan')->constrained('pengadaan')->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnDelete();
            $table->boolean('status');
            $table->bigInteger('jumlahBarangRencana')->nullable();
            $table->bigInteger('jumlahBarangRealisasi')->nullable();
            $table->bigInteger('hargaBarangRencana')->nullable();
            $table->bigInteger('hargaBarangRealisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengadaan_barangs');
    }
};
