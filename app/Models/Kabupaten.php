<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'provinsi_id',
        // tambahkan kolom lain jika ada
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function depots()
    {
        return $this->hasMany(Depot::class);
    }
}
