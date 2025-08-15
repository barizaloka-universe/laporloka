<?php

// database/migrations/2024_01_01_000001_create_laporan_table.php

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
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            
            // Status & Tracking
            $table->enum('status', [
                'terkirim', 
                'diterima', 
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