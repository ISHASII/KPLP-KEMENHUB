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
        Schema::table('pengelolaan_laporan_masuk', function (Blueprint $table) {
            if (!Schema::hasColumn('pengelolaan_laporan_masuk', 'gambar')) {
                $table->string('gambar')->nullable()->after('tertunda');
            }
            if (!Schema::hasColumn('pengelolaan_laporan_masuk', 'dokumen')) {
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
        Schema::table('pengelolaan_laporan_masuk', function (Blueprint $table) {
            if (Schema::hasColumn('pengelolaan_laporan_masuk', 'dokumen')) {
                $table->dropColumn('dokumen');
            }
            if (Schema::hasColumn('pengelolaan_laporan_masuk', 'gambar')) {
                $table->dropColumn('gambar');
            }
        });
    }
};
