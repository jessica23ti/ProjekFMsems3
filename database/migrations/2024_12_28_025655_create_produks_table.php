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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id'); // Foreign key ke tabel users
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('jumlah_stok')->default(0);
            $table->integer('harga');
            $table->integer('diskon')->default(0);
            $table->timestamps();
            // Relasi ke tabel users

            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
