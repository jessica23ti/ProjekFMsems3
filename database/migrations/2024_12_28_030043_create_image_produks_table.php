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
        Schema::create('image_produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');  // Foreign key ke produk
            $table->string('image_path');              // Lokasi gambar
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_produks');
    }
};
