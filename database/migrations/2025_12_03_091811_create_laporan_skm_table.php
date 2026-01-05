<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_skm', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('responden')->default(0);
            $table->decimal('ipk', 5, 2)->default(0);
            $table->decimal('ikm', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_skm');
    }
};
