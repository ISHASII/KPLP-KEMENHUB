<?php

namespace App\Http\Controllers;

use App\Models\LaporanSkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanSkmController extends Controller
{
    // Menampilkan semua data SKM
    public function index()
    {
        $data = LaporanSkm::orderBy('tanggal', 'desc')->get();
        return view('laporan_skm', compact('data'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'responden' => 'required|integer|min:0',
            'ipk' => 'required|numeric|min:0|max:100',
            'ikm' => 'required|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('laporan_skm', 'public');
        }

        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('laporan_skm', 'public');
        }

        LaporanSkm::create([
            'tanggal' => $request->tanggal,
            'responden' => $request->responden,
            'ipk' => $request->ipk,
            'ikm' => $request->ikm,
            'gambar' => $gambarPath,
            'dokumen' => $dokumenPath,
        ]);

        return redirect()->back()->with('success', 'Data SKM berhasil ditambahkan!');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'responden' => 'required|integer|min:0',
            'ipk' => 'required|numeric|min:0|max:100',
            'ikm' => 'required|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $laporan = LaporanSkm::findOrFail($id);
        $updateData = [
            'tanggal' => $request->tanggal,
            'responden' => $request->responden,
            'ipk' => $request->ipk,
            'ikm' => $request->ikm,
        ];

        if ($request->hasFile('gambar')) {
            if ($laporan->gambar) {
                Storage::disk('public')->delete($laporan->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('laporan_skm', 'public');
        }

        if ($request->hasFile('dokumen')) {
            if ($laporan->dokumen) {
                Storage::disk('public')->delete($laporan->dokumen);
            }
            $updateData['dokumen'] = $request->file('dokumen')->store('laporan_skm', 'public');
        }

        $laporan->update($updateData);

        return redirect()->back()->with('success', 'Data SKM berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $laporan = LaporanSkm::findOrFail($id);
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
