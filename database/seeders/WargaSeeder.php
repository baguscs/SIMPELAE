<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Warga;
use App\Models\Wilayah_rt;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        Warga::query()->create([
            'wilayah_rts_id' => 1,
            'nik' => $faker->unique()->numberBetween(1111111111111111, 9999999999999999),
            'no_kk' => $faker->unique()->numberBetween(1111111111111111, 9999999999999999),
            'nama_warga' => 'Admin',
            'tempat_lahir' => $faker->city,
            'tanggal_lahir' => $faker->dateTime,
            'jenis_kelamin' => "Laki-Laki",
            'agama' => 'Islam',
            'alamat' => $faker->streetAddress,
            'pekerjaan' => $faker->jobTitle,
            'kewarganegaraan' => 'Indonesia',
            'no_telp' => $faker->phoneNumber,
            'status_akun' => 1,
        ]);

        $region = Wilayah_rt::query()->get();

        $region->map(function ($region) use($faker) {
            Warga::query()->create([
                'wilayah_rts_id' => $region->id,
                'nik' => $faker->unique()->numberBetween(1111111111111111, 9999999999999999),
                'no_kk' => $faker->unique()->numberBetween(1111111111111111, 9999999999999999),
                'nama_warga' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTime,
                'jenis_kelamin' => "Laki-Laki",
                'agama' => 'Islam',
                'alamat' => $faker->streetAddress,
                'pekerjaan' => $faker->jobTitle,
                'kewarganegaraan' => 'Indonesia',
                'no_telp' => $faker->phoneNumber,
            ]);
        });
    }
}
