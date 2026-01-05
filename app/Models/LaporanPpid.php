<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPpid extends Model
{
    protected $table = 'laporan_ppid';

    protected $fillable = [
        'tanggal',
        'jumlah_pemohon',
    ];
}
