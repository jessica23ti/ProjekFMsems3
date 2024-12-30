<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'jumlah_stok', 'harga', 'diskon', 'kategori_id', 'ukuran', 'berat'];
    public function order()
    {
        return $this->belongsToMany(Pemesanan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ImageProduk::class, 'product_id');
    }
    public function pemesanan()
    {
        return $this->belongsToMany(Pemesanan::class, 'order_products', 'product_id', 'order_id');
    }
    // public function review()
    // {
    //     return $this->belongsToMany(User::class, 'review', 'product_id', 'user_id')
    //         ->withPivot('review', 'rating')
    //         ->withTimestamps();
    // }
    public function kategori()
    {
        return $this->belongsTo(Category::class);
    }
    // Menambahkan cascading delete untuk relasi gambar
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($produk) {
            // Jika Anda ingin menghapus gambar produk secara manual
            $produk->images()->delete();
        });
    }
}
