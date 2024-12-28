<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduk extends Model
{
    protected $fillable = ['product_id', 'image_path'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
