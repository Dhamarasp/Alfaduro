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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori')->cascadeOnDelete();
            $table->foreignId('id_merek')->constrained('merek')->cascadeOnDelete();
            $table->foreignId('id_satuan')->constrained('satuan')->cascadeOnDelete();
            $table->string('namabarang')->nullable();
            $table->string('gambarBarang')->nullable();
            $table->bigInteger('stokBarang')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('hargaJual')->nullable();
            $table->bigInteger('hargaBeli')->nullable();
            $table->bigInteger('laba')->nullable();
            $table->date('tanggalMasuk')->nullable();
            $table->date('tanggalExpire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
