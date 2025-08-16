<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();

            $table->string('judul_laporan');
            $table->text('deskripsi');
            $table->string('lokasi_detail');
            
            // Tambahkan kolom untuk foreign key
            $table->string('desa_id');

            // Status & Tracking
            $table->enum('status', [
                'terkirim',
                'duplikat',
                'diproses', 
                'selesai', 
                'ditolak',
                'butuh_info_tambahan'
            ])->default('terkirim');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'darurat'])->default('sedang');
            
            $table->text('catatan_admin')->nullable();
            $table->text('alasan_penolakan')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Tambahkan foreign key constraint
            $table->foreign('desa_id')->references('kode_desa')->on('desa')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};