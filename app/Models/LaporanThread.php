<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\Laporan;

class LaporanThread extends Model
{
    protected $table = 'laporan_thread';

    protected $guarded = ['id'];

    public function user(): BelongsTo | null
    {
        return $this->belongsTo(User::class);
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class);
    }
}
