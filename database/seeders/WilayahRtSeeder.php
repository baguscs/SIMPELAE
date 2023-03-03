<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahRtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wilayah_rts')->insert([
            'wilayah' => 'RT 01',
        ]);
        DB::table('wilayah_rts')->insert([
            'wilayah' => 'RT 02',
        ]);
        DB::table('wilayah_rts')->insert([
            'wilayah' => 'RT 03',
        ]);
        DB::table('wilayah_rts')->insert([
            'wilayah' => 'RT 04',
        ]);
        DB::table('wilayah_rts')->insert([
            'wilayah' => 'RT 05',
        ]);
    }
}
