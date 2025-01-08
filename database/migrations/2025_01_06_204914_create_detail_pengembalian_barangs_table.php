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
        Schema::create('detail_pengembalian_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengembalian')->constrained('pengembalian')->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnDelete();
            $table->integer('status');
            $table->text('alasan')->nullable();
            $table->bigInteger('jumlahBarangKembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengembalian_barang');
    }
};
