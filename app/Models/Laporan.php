<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums\LaporanStatus;
use App\Enums\LaporanPrioritas;
use App\Models\LaporanThread;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'laporan';

    protected $guarded = ['id'];

    /**
     * Atribut yang harus diubah ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => LaporanStatus::class,
        'prioritas' => LaporanPrioritas::class,
    ];

    public function threads()
    {
        return $this->hasMany(LaporanThread::class, 'laporan_id');
    }
}
