<?php

namespace App\Enums;

enum LaporanPrioritas: string
{
    case Rendah = 'rendah';
    case Sedang = 'sedang';
    case Tinggi = 'tinggi';
    case Darurat = 'darurat';
}
