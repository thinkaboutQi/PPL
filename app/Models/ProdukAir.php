<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAir extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_produk',
        'harga',
        'satuan',
        'deskripsi',
        'gambar',
    ];
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'produk_air_id');
    }
}
