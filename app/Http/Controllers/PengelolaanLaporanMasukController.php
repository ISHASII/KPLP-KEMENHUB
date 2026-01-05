<?php

namespace App\Http\Controllers;

use App\Models\PengelolaanLaporanMasuk;
use Illuminate\Http\Request;

class PengelolaanLaporanMasukController extends Controller
{
    public function index()
    {
        $data = PengelolaanLaporanMasuk::orderBy('tanggal', 'desc')->get();
        return view('laporan_masuk', compact('data')); // Ganti ke 'laporan_masuk'
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'belum_terverifikasi' => 'required|integer|min:0',
            'terdisposisi_belum_tindak_lanjut' => 'required|integer|min:0',
            'terdisposisi_sedang_proses' => 'required|integer|min:0',
            'terdisposisi_selesai' => 'required|integer|min:0',
            'tertunda' => 'required|integer|min:0',
        ]);

        PengelolaanLaporanMasuk::create($validated);

        return back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'belum_terverifikasi' => 'required|integer|min:0',
            'terdisposisi_belum_tindak_lanjut' => 'required|integer|min:0',
            'terdisposisi_sedang_proses' => 'required|integer|min:0',
            'terdisposisi_selesai' => 'required|integer|min:0',
            'tertunda' => 'required|integer|min:0',
        ]);

        PengelolaanLaporanMasuk::findOrFail($id)->update($validated);

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PengelolaanLaporanMasuk::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}