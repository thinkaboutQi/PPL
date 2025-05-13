<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'produk_air_id', 'quantity', 'harga_satuan',
    ];

    /**
     * Relasi ke model Order
     * Setiap OrderItem berhubungan dengan satu Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke model ProdukAir
     * Setiap OrderItem berhubungan dengan satu ProdukAir
     */
    public function ProdukAir()
    {
        return $this->belongsTo(ProdukAir::class, 'produk_air_id');
    }
}
