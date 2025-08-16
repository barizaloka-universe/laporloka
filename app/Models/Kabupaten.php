<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Provinsi;
use App\Models\Kecamatan;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';

    protected $fillable = [
        'nama_kabupaten',
        'kode_kabupaten',
        'id_provinsi',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten');
    }
}
