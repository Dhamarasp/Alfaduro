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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions')->cascadeOnDelete()->cascadeOnUpdate();

            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('qty');
            $table->integer('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};