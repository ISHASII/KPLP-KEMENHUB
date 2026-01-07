<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan_publik', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('tamu_kantor');
            $table->string('dokumen')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('layanan_publik', function (Blueprint $table) {
            $table->dropColumn(['gambar', 'dokumen']);
        });
    }
};
