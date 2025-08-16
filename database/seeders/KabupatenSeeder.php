<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kabupaten' => 'Rembang',
                'kode_kabupaten' => 17,
                'provinsi_id' => 33,
            ]
        ];

        foreach ($data as $kabupaten) {
            \App\Models\Kabupaten::create($kabupaten);
        }
    }
}
