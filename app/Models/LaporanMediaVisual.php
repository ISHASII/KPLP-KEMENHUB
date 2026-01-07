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
        'gambar',
        'dokumen',
    ];

    // Accessors for public file URLs
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getDokumenUrlAttribute()
    {
        return $this->dokumen ? asset('storage/' . $this->dokumen) : null;
    }
}
