<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProdukAir;

class ProdukAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // ProdukAir:factory(10)->Create();
        // ProdukAir::truncate();

        ProdukAir::create([
            'nama_produk' => 'Jerigen Air Bersih',
            'harga' => 30000,
            'satuan' => '25',
            'deskripsi' => 'Air bersih dalam jerigen',
            'gambar' => 'img/dirigen.png',
        ]);
        ProdukAir::create([
            'nama_produk' => 'Truk Tangki Air Bersih',
            'harga' => 200000,
            'satuan' => '2000',
            'deskripsi' => 'Air bersih dalam truk tangki',
            'gambar' => 'img/truk.jpg',
        ]);
        ProdukAir::create([
            'nama_produk' => 'Galon Air Bersih',
            'harga' => 10000,
            'satuan' => '5',
            'deskripsi' => 'Air bersih dalam galon',
            'gambar' => 'img/galon.png',
        ]);
        ProdukAir::create([
            'nama_produk' => 'Drum Air Bersih',
            'harga' => 50000,
            'satuan' => '200',
            'deskripsi' => 'Air bersih dalam drum',
            'gambar' => 'img/drum.png',
        ]);
    }
}
