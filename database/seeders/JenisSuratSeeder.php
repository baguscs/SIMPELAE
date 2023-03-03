<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_surats')->insert([
            'jenis' => 'Kelahiran',
        ]);
        DB::table('jenis_surats')->insert([
            'jenis' => 'Kematian',
        ]);
        DB::table('jenis_surats')->insert([
            'jenis' => 'Keterangan Miskin',
        ]);
    }
}
