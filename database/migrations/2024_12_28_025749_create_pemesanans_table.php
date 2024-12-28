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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel User
            $table->unsignedBigInteger('product_id'); // Relasi ke tabel Product
            $table->enum('status_pesan', ['Pending', 'Processing', 'Shipped', 'Canceled', 'Delivered', 'Returned', ' di Keranjang'])->default('Pending');
            $table->text('shipping_address');
            $table->String('payment_method');
            $table->date('tanggal_pemesanan');
            $table->integer('total_item_pesanan');
            $table->decimal('total_biaya', 10, 2);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
