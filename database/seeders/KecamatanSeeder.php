<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data for seeding
        $data = [
            [
                'nama_kecamatan' => 'Sedan',
                'kode_kecamatan' => '06',
                'kabupaten_id' => '17',
            ]
        ];

        foreach ($data as $kecamatan) {
            \App\Models\Kecamatan::create($kecamatan);
        }
    }
}
