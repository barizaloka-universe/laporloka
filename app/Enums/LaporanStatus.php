<?php

namespace App\Enums;

enum LaporanStatus: string
{
    case Terkirim = 'terkirim';
    case Duplikat = 'duplikat';
    case Diproses = 'diproses';
    case Selesai = 'selesai';
    case Ditolak = 'ditolak';
    case ButuhInfoTambahan = 'butuh_info_tambahan';
}
