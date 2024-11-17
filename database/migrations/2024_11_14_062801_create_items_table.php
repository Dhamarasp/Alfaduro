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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->nullable()->references('id')->on('brands')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->nullable()->references('id')->on('categories')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->string('nameItem');
            $table->string('image');
            $table->integer('price')->unsigned();
            $table->integer('stock')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
