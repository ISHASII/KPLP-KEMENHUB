<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPublik extends Model
{
    protected $table = 'layanan_publik';

    protected $fillable = [
        'tanggal',
        'penyidikan_penyelidikan',
        'patroli_kapal',
        'sar',
        'snbp',
        'pengawasan_salvage',
        'marpol',
        'tamu_kantor',
        'gambar',
        'dokumen',
    ];

    // Accessors to get public URLs for files
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getDokumenUrlAttribute()
    {
        return $this->dokumen ? asset('storage/' . $this->dokumen) : null;
    }
}
