<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengelolaanLaporanMasuk extends Model
{
    protected $table = 'pengelolaan_laporan_masuk';

    protected $fillable = [
        'tanggal',
        'belum_terverifikasi',
        'terdisposisi_belum_tindak_lanjut',
        'terdisposisi_sedang_proses',
        'terdisposisi_selesai',
        'tertunda',
    ];
}
