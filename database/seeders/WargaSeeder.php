<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wargas')->insert([
            'wilayah_rts_id' => 1,
            'nik' => 111,
            'no_kk' => 123,
            'nama_warga' => 'Dumy Name',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2022-01-11',
            'jenis_kelamin' => 'Laki_Laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Surabaya',
            'pekerjaan' => 'Programmmer',
            'kewarganegaraan' => 'Indonesia',
            'no_telp' => '089123123213',
            'status_akun' => 1,
        ]);
    }
}
