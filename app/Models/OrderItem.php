<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
    ];

    /**
     * Get the order associated with the OrderProduct.
     */
    public function pemesanan()
    {
        return $this->belongsTo(pemesanan::class, 'id');
    }

    /**
     * Get the product associated with the OrderProduct.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id');
    }
}
