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
        Schema::table('laporan', function (Blueprint $table) {
            // Hapus kolom 'alasan_penolakan' dari tabel 'laporan'
            if (Schema::hasColumn('laporan', 'alasan_penolakan')) {
                $table->dropColumn('alasan_penolakan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            // Tambahkan kembali kolom 'alasan_penolakan' ke tabel 'laporan'
            $table->text('alasan_penolakan')->nullable()->after('catatan_admin');
        });
    }
};
