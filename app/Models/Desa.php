<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;

class Desa extends Model
{
    protected $table = 'desa';

    protected $fillable = [
        'nama_desa',
        'kode_desa',
        'kecamatan_id',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
