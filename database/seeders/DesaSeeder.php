<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data for seeding
        $data = [
            [
                'nama_desa' => 'Karangasem',
                'kode_desa' => '2008',
                'kecamatan_id' => '06',
            ]
        ];

        foreach ($data as $desa) {
            \App\Models\Desa::create($desa);
        }
    }
}
