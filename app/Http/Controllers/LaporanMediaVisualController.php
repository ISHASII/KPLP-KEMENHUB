<?php

namespace App\Http\Controllers;

use App\Models\LaporanMediaVisual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanMediaVisualController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $data = LaporanMediaVisual::orderBy('tanggal', 'desc')->get();
        return view('laporan_media', compact('data'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'tayangan_postingan' => 'required|integer|min:0',
            'pengikut' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('laporan_media_visual', 'public');
        }

        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('laporan_media_visual', 'public');
        }

        LaporanMediaVisual::create([
            'tanggal' => $request->tanggal,
            'tayangan_postingan' => $request->tayangan_postingan,
            'pengikut' => $request->pengikut,
            'gambar' => $gambarPath,
            'dokumen' => $dokumenPath,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Update data - TAMBAHKAN METHOD INI
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'tayangan_postingan' => 'required|integer|min:0',
            'pengikut' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $laporan = LaporanMediaVisual::findOrFail($id);

        $updateData = [
            'tanggal' => $request->tanggal,
            'tayangan_postingan' => $request->tayangan_postingan,
            'pengikut' => $request->pengikut,
        ];

        if ($request->hasFile('gambar')) {
            if ($laporan->gambar) {
                Storage::disk('public')->delete($laporan->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('laporan_media_visual', 'public');
        }

        if ($request->hasFile('dokumen')) {
            if ($laporan->dokumen) {
                Storage::disk('public')->delete($laporan->dokumen);
            }
            $updateData['dokumen'] = $request->file('dokumen')->store('laporan_media_visual', 'public');
        }

        $laporan->update($updateData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $laporan = LaporanMediaVisual::findOrFail($id);
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
