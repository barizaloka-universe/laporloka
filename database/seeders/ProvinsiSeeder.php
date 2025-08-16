<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_provinsi' => 'Jawa Tengah',
                'kode_provinsi' => '33',
            ]
        ];

        foreach ($data as $provinsi) {
            \App\Models\Provinsi::create($provinsi);
        }
    }
}
