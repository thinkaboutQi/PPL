<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepotSeeder extends Seeder
{
    public function run()
    {
        DB::table('tokos')->insert([
            [
                'nama_toko' => 'Dewi Spring Water',
                'alamat' => 'Jl. Medan Merdeka, Gambir',
                'telepon' => '081234567890',
                'provinsi_id' => 1,
                'kabupaten_id' => 1,
                'kecamatan_id' => 1,
            ],
            [
                'nama_toko' => 'Depot Air zeger',
                'alamat' => 'Jl. Palmerah Utara No.10',
                'telepon' => '081234500001',
                'provinsi_id' => 1,
                'kabupaten_id' => 2,
                'kecamatan_id' => 2,
            ],
            [
                'nama_toko' => 'Air Widhi Bejo',
                'alamat' => 'Jl. Dermaga Raya, Duren Sawit',
                'telepon' => '081234500002',
                'provinsi_id' => 1,
                'kabupaten_id' => 3,
                'kecamatan_id' => 3,
            ],
            [
                'nama_toko' => 'Adit Autumn Water',
                'alamat' => 'Jl. Panglima Polim, Kebayoran Baru',
                'telepon' => '081234500003',
                'provinsi_id' => 1,
                'kabupaten_id' => 4,
                'kecamatan_id' => 4,
            ],
            [
                'nama_toko' => 'Agen Zein Berkah',
                'alamat' => 'Jl. Boulevard Raya, Kelapa Gading',
                'telepon' => '081234500004',
                'provinsi_id' => 1,
                'kabupaten_id' => 5,
                'kecamatan_id' => 5,
            ],
        ]);
    }
}
