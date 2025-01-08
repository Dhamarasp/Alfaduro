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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pegawai')->constrained('pegawai')->cascadeOnDelete();
            $table->foreignId('id_pembayaran')->nullable()->constrained('jenis_pembayaran')->cascadeOnDelete();
            $table->foreignId('id_layanan')->nullable()->constrained('layanan_pemesanan')->cascadeOnDelete();
            $table->date('tanggalTransaksi')->nullable();
            $table->bigInteger('totalHarga')->nullable();
            $table->bigInteger('uang')->nullable();
            $table->bigInteger('uangKembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
