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
        'desa_id',
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
     * Relasi ke model Desa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'kode_desa');
    }
}
