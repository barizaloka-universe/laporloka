<?php

namespace App\Filament\Resources\Laporans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\Desa;
use App\Enums\LaporanStatus;
use App\Enums\LaporanPrioritas;

class LaporanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul_laporan')
                    ->label('Judul Laporan')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(5)
                    ->required()
                    ->readOnly(),
                TextInput::make('lokasi_detail')
                    ->label('Detail Lokasi')
                    ->maxLength(255)
                    ->readOnly(),
                TextInput::make('status')
                    ->label('Status Laporan')
                    ->required()
                    ->readOnly(),
                TextInput::make('prioritas')
                    ->label('Prioritas Laporan')
                    ->required()
                    ->readOnly(),
                Textarea::make('catatan_admin')
                    ->label('Catatan Admin')
                    ->rows(3),
            ]);
    }
}
