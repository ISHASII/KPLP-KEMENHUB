<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSkm extends Model
{
    protected $table = 'laporan_skm';

    protected $fillable = [
        'tanggal',
        'responden',
        'ipk',
        'ikm',
    ];
}
