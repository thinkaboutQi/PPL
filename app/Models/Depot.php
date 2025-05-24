<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    protected $table = 'tokos';
    protected $fillable = [
        'nama_toko',
        'alamat',
        'telepon',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        // tambahkan kolom lain jika ada
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
