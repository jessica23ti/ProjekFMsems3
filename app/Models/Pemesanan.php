<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'order_products', 'order_id', 'product_id');
    }
    public function getFormattedTotalBiayaAttribute()
    {
        return 'Rp ' . number_format($this->total_biaya, 0, ',', '.');
    }

    /**
     * Contoh Method untuk Mengupdate Status
     */
    public function updateStatus($status)
    {
        $this->status_pesan = $status;
        $this->save();
    }
}
