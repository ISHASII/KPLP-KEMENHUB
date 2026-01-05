<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanBeritaKplp extends Model
{
    protected $table = 'laporan_berita_kplp';

    protected $fillable = [
        'tanggal',
        'jumlah_berita_positif',
        'jumlah_berita_negatif',
    ];
}
