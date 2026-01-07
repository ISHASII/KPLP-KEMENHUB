<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPpid extends Model
{
    protected $table = 'laporan_ppid';

    protected $fillable = [
        'tanggal',
        'jumlah_pemohon',
        'gambar',
        'dokumen',
    ];

    // Accessors for public URLs
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getDokumenUrlAttribute()
    {
        return $this->dokumen ? asset('storage/' . $this->dokumen) : null;
    }
}
