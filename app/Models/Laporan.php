<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\LaporanStatus;
use App\Enums\LaporanPrioritas;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'laporan';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul_laporan',
        'deskripsi',
        'lokasi_detail',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'status',
        'prioritas',
        'catatan_admin',
        'alasan_penolakan',
    ];

    /**
     * Atribut yang harus diubah ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => LaporanStatus::class,
        'prioritas' => LaporanPrioritas::class,
    ];

    /**
     * Atribut default.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'terkirim',
        'prioritas' => 'sedang',
    ];
}
