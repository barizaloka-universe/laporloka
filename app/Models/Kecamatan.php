<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;
use App\Models\Desa;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    
    protected $fillable = [
        'nama_kecamatan',
        'kode_kecamatan',
        'id_kabupaten',
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function desa()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan');
    }
}
