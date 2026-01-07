<?php

namespace App\Http\Controllers;

use App\Models\LaporanPpid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanPpidController extends Controller
{
    // Menampilkan semua laporan
    public function index()
    {
        $data = LaporanPpid::orderBy('tanggal', 'desc')->get();
        return view('laporan_ppid', compact('data'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_pemohon' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('laporan_ppid', 'public');
        }

        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('laporan_ppid', 'public');
        }

        LaporanPpid::create([
            'tanggal' => $request->tanggal,
            'jumlah_pemohon' => $request->jumlah_pemohon,
            'gambar' => $gambarPath,
            'dokumen' => $dokumenPath,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_pemohon' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $laporan = LaporanPpid::findOrFail($id);

        $updateData = [
            'tanggal' => $request->tanggal,
            'jumlah_pemohon' => $request->jumlah_pemohon,
        ];

        if ($request->hasFile('gambar')) {
            if ($laporan->gambar) {
                Storage::disk('public')->delete($laporan->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('laporan_ppid', 'public');
        }

        if ($request->hasFile('dokumen')) {
            if ($laporan->dokumen) {
                Storage::disk('public')->delete($laporan->dokumen);
            }
            $updateData['dokumen'] = $request->file('dokumen')->store('laporan_ppid', 'public');
        }

        $laporan->update($updateData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus satu data
    public function destroy($id)
    {
        $laporan = LaporanPpid::findOrFail($id);
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
