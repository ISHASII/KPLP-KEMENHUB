<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengelolaan_laporan_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('belum_terverifikasi')->default(0);
            $table->integer('terdisposisi_belum_tindak_lanjut')->default(0);
            $table->integer('terdisposisi_sedang_proses')->default(0);
            $table->integer('terdisposisi_selesai')->default(0);
            $table->integer('tertunda')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengelolaan_laporan_masuk');
    }
};
