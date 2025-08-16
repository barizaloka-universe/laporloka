<?php

namespace App\Filament\Resources\Laporans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Desa; // Pastikan model Desa sudah di-import
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class LaporansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_laporan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('deskripsi')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('desa.nama_desa')
                    ->label('Desa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status'),
                TextColumn::make('prioritas'),
                // TextColumn::make('status')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'terkirim' => 'gray',
                //         'diterima' => 'info',
                //         'diproses' => 'warning',
                //         'selesai' => 'success',
                //         'ditolak' => 'danger',
                //         'butuh_info_tambahan' => 'warning',
                //     })
                //     ->sortable(),
                // TextColumn::make('prioritas')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'rendah' => 'gray',
                //         'sedang' => 'info',
                //         'tinggi' => 'warning',
                //         'darurat' => 'danger',
                //     })
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                 SelectFilter::make('desa_id')
                    ->label('Filter berdasarkan Desa')
                    ->relationship('desa', 'nama_desa')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

