<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_siaran_pers', function (Blueprint $table) {
            if (!Schema::hasColumn('laporan_siaran_pers', 'gambar')) {
                $table->string('gambar')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('laporan_siaran_pers', 'dokumen')) {
                $table->string('dokumen')->nullable()->after('gambar');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_siaran_pers', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_siaran_pers', 'dokumen')) {
                $table->dropColumn('dokumen');
            }
            if (Schema::hasColumn('laporan_siaran_pers', 'gambar')) {
                $table->dropColumn('gambar');
            }
        });
    }
};
