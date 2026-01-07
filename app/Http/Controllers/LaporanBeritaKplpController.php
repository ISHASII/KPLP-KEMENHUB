<?php

namespace App\Http\Controllers;

use App\Models\LaporanBeritaKplp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('laporan_berita_kplp', 'public');
        }

        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('laporan_berita_kplp', 'public');
        }

        LaporanBeritaKplp::create([
            'tanggal' => $request->tanggal,
            'jumlah_berita_positif' => $request->jumlah_berita_positif,
            'jumlah_berita_negatif' => $request->jumlah_berita_negatif,
            'gambar' => $gambarPath,
            'dokumen' => $dokumenPath,
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $laporan = LaporanBeritaKplp::findOrFail($id);

        $updateData = [
            'tanggal' => $request->tanggal,
            'jumlah_berita_positif' => $request->jumlah_berita_positif,
            'jumlah_berita_negatif' => $request->jumlah_berita_negatif,
        ];

        if ($request->hasFile('gambar')) {
            if ($laporan->gambar) {
                Storage::disk('public')->delete($laporan->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('laporan_berita_kplp', 'public');
        }

        if ($request->hasFile('dokumen')) {
            if ($laporan->dokumen) {
                Storage::disk('public')->delete($laporan->dokumen);
            }
            $updateData['dokumen'] = $request->file('dokumen')->store('laporan_berita_kplp', 'public');
        }

        $laporan->update($updateData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $laporan = LaporanBeritaKplp::findOrFail($id);
        if ($laporan->gambar) {
            Storage::disk('public')->delete($laporan->gambar);
        }
        if ($laporan->dokumen) {
            Storage::disk('public')->delete($laporan->dokumen);
        }
        $laporan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
