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
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pegawai')->constrained('pegawai')->cascadeOnDelete();
            $table->foreignId('id_supplier')->constrained('supplier')->cascadeOnDelete();
            $table->date('tanggalRencana')->nullable();
            $table->date('tanggalRealisasi')->nullable();
            $table->bigInteger('anggaranRencana')->nullable();
            $table->bigInteger('anggaranRealisasi')->nullable();
            $table->bigInteger('jumlahRencana')->nullable();
            $table->bigInteger('jumlahRealisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaan');
    }
};
