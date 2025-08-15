<?php

namespace Database\Factories;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Nama model yang terkait dengan factory ini.
     *
     * @var string
     */
    protected $model = Laporan::class;

    /**
     * Tentukan definisi model default.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = [
            'terkirim',
            'diterima',
            'diproses',
            'selesai',
            'ditolak',
            'butuh_info_tambahan'
        ];

        $priorities = [
            'rendah',
            'sedang',
            'tinggi',
            'darurat'
        ];

        return [
            'judul_laporan' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
            'lokasi_detail' => $this->faker->address(),
            'desa' => $this->faker->city(),
            'kecamatan' => $this->faker->citySuffix(),
            'kabupaten' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
            'status' => $this->faker->randomElement($statuses),
            'prioritas' => $this->faker->randomElement($priorities),
            // catatan_admin dan alasan_penolakan dibuat opsional
            'catatan_admin' => $this->faker->boolean(20) ? $this->faker->sentence() : null,
            'alasan_penolakan' => $this->faker->boolean(10) ? $this->faker->sentence() : null,
        ];
    }
}
