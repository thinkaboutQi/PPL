<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        DB::table('provinsis')->insert([
            ['id' => 1, 'nama' => 'DKI Jakarta'],
        ]);
    }
}