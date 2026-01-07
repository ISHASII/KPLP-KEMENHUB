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
