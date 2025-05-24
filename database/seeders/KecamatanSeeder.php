<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kecamatans')->insert([
            ['id' => 1, 'kabupaten_id' => 1, 'nama' => 'Gambir'],
            ['id' => 2, 'kabupaten_id' => 2, 'nama' => 'Palmerah'],
            ['id' => 3, 'kabupaten_id' => 3, 'nama' => 'Duren Sawit'],
            ['id' => 4, 'kabupaten_id' => 4, 'nama' => 'Kebayoran Baru'],
            ['id' => 5, 'kabupaten_id' => 5, 'nama' => 'Kelapa Gading'],
        ]);
    }
}
