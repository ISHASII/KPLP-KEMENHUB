<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSiaranPers extends Model
{
    protected $table = 'laporan_siaran_pers';

    protected $fillable = [
        'jumlah_siaran_pers',
        'tanggal',
    ];
}
