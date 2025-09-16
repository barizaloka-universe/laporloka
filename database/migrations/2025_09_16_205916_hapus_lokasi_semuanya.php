<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::beginTransaction();

        // remove relation between laporan and desa
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropColumn('desa_id');
        });

        /**
         * This migration script is responsible for dropping the following tables:
         * - 'desa': Represents villages or local areas.
         * - 'kecamatan': Represents sub-districts.
         * - 'kabupaten': Represents districts or regencies.
         * - 'provinsi': Represents provinces.
         *
         * By executing this migration, all data within these tables will be permanently removed.
         * Ensure that this operation is intentional and that any necessary backups have been created.
         */
        Schema::dropIfExists('desa');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kabupaten');
        Schema::dropIfExists('provinsi');

        DB::commit();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::beginTransaction();

        // Restore the relationship between laporan and desa
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('desa_id')->nullable();
            $table->foreign('desa_id')->references('kode_desa')->on('desa')->onDelete('set null');
        }); 

        Schema::create('provinsi', function (Blueprint $table) {
            $table->string('kode_provinsi')->primary();
            $table->string('nama_provinsi');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('kabupaten', function (Blueprint $table) {
            $table->string('kode_kabupaten')->primary();
            $table->string('nama_kabupaten');
            $table->string('kode_provinsi');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kode_provinsi')->references('kode_provinsi')->on('provinsi')->onDelete('cascade');
        });
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->string('kode_kecamatan')->primary();
            $table->string('nama_kecamatan');
            $table->string('kode_kabupaten');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kode_kabupaten')->references('kode_kabupaten')->on('kabupaten')->onDelete('cascade');
        });
        Schema::create('desa', function (Blueprint $table) {
            $table->string('kode_desa')->primary();
            $table->string('nama_desa');
            $table->string('kode_kecamatan');
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign('kode_kecamatan')
                ->references('kode_kecamatan')
                ->on('kecamatan')
                ->onDelete('cascade');
        });

        DB::commit();
    }
};
