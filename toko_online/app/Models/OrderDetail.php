<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    // Primary key gabungan (id_order + id_barang) tidak didukung langsung oleh Eloquent
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_order',
        'id_barang',
        'harga_satuan',
        'jumlah_beli',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_barang', 'id_barang');
    }
}