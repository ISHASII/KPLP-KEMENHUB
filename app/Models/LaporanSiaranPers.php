<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSiaranPers extends Model
{
    protected $table = 'laporan_siaran_pers';

    protected $fillable = [
        'jumlah_siaran_pers',
        'tanggal',
        'gambar',
        'dokumen',
    ];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : '';
    }

    public function getDokumenUrlAttribute()
    {
        return $this->dokumen ? asset('storage/' . $this->dokumen) : '';
    }
}
