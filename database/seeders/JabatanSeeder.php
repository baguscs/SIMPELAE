<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            'jabatan' => 'Ketua RW',
        ]);
        DB::table('jabatans')->insert([
            'jabatan' => 'Ketua RT',
        ]);
        DB::table('jabatans')->insert([
            'jabatan' => 'Warga',
        ]);
    }
}
