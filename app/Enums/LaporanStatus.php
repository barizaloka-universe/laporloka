<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum LaporanStatus: string
{
    use EnumToArray;
    
    case Terkirim = 'terkirim';
    case Duplikat = 'duplikat';
    case Diproses = 'diproses';
    case Selesai = 'selesai';
    case Ditolak = 'ditolak';
    case ButuhInfoTambahan = 'butuh_info_tambahan';
}
