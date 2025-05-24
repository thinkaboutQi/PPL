<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    public function run()
    {
        DB::table('kabupatens')->insert([
            ['id' => 1, 'provinsi_id' => 1, 'nama' => 'Jakarta Pusat'],
            ['id' => 2, 'provinsi_id' => 1, 'nama' => 'Jakarta Barat'],
            ['id' => 3, 'provinsi_id' => 1, 'nama' => 'Jakarta Timur'],
            ['id' => 4, 'provinsi_id' => 1, 'nama' => 'Jakarta Selatan'],
            ['id' => 5, 'provinsi_id' => 1, 'nama' => 'Jakarta Utara'],
        ]);
    }
}
