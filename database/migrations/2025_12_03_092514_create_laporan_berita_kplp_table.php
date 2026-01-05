<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_berita_kplp', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('jumlah_berita_positif')->default(0);
            $table->integer('jumlah_berita_negatif')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_berita_kplp');
    }
};
