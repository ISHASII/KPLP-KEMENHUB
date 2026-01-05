<?php

namespace App\Http\Controllers;

use App\Models\LaporanBeritaKplp;
use Illuminate\Http\Request;

class LaporanBeritaKplpController extends Controller
{
    // Menampilkan semua laporan
    public function index()
    {
        $data = LaporanBeritaKplp::orderBy('tanggal', 'desc')->get();
        return view('laporan_kplp', compact('data'));
    }

    // Menyimpan data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_berita_positif' => 'required|integer|min:0',
            'jumlah_berita_negatif' => 'required|integer|min:0',
        ]);

        LaporanBeritaKplp::create([
            'tanggal' => $request->tanggal,
            'jumlah_berita_positif' => $request->jumlah_berita_positif,
            'jumlah_berita_negatif' => $request->jumlah_berita_negatif,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // TAMBAHKAN METHOD UPDATE INI
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_berita_positif' => 'required|integer|min:0',
            'jumlah_berita_negatif' => 'required|integer|min:0',
        ]);

        $laporan = LaporanBeritaKplp::findOrFail($id);
        
        $laporan->update([
            'tanggal' => $request->tanggal,
            'jumlah_berita_positif' => $request->jumlah_berita_positif,
            'jumlah_berita_negatif' => $request->jumlah_berita_negatif,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        LaporanBeritaKplp::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}