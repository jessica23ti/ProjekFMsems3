<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'total_item_pesanan',
        'total_biaya',
        'status_pesan',
        'shipping_address',
        'payment_method',
        'tanggal_pemesanan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Produk::class);
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
