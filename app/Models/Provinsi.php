<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    protected $fillable = [
        'nama_provinsi',
        'kode_provinsi',
    ];

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'id_provinsi');
    }
}
