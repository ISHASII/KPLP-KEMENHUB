<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_publik', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');

            // Ubah dari boolean ke integer
            $table->integer('penyidikan_penyelidikan')->default(0);
            $table->integer('patroli_kapal')->default(0);
            $table->integer('sar')->default(0);
            $table->integer('snbp')->default(0);
            $table->integer('pengawasan_salvage')->default(0);
            $table->integer('marpol')->default(0);
            $table->integer('tamu_kantor')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_publik');
    }
};
