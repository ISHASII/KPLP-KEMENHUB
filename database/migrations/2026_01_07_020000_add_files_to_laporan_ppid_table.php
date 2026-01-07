<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_ppid', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('jumlah_pemohon');
            $table->string('dokumen')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('laporan_ppid', function (Blueprint $table) {
            $table->dropColumn(['gambar', 'dokumen']);
        });
    }
};
