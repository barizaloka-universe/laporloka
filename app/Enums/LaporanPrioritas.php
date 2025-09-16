<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum LaporanPrioritas: string
{
    use EnumToArray;

    case Rendah = 'rendah';
    case Sedang = 'sedang';
    case Tinggi = 'tinggi';
    case Darurat = 'darurat';
}
