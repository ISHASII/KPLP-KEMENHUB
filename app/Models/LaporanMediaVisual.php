<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanMediaVisual extends Model
{
    protected $table = 'laporan_media_visual';

    protected $fillable = [
        'tanggal',
        'tayangan_postingan',
        'pengikut',
    ];
}
