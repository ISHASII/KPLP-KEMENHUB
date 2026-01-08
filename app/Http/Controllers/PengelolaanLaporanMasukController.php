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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $payload = $request->only([
            'tanggal', 'belum_terverifikasi', 'terdisposisi_belum_tindak_lanjut',
            'terdisposisi_sedang_proses', 'terdisposisi_selesai', 'tertunda'
        ]);

        if ($request->hasFile('gambar')) {
            $payload['gambar'] = $request->file('gambar')->store('pengelolaan_laporan_masuk', 'public');
        }

        if ($request->hasFile('dokumen')) {
            $payload['dokumen'] = $request->file('dokumen')->store('pengelolaan_laporan_masuk', 'public');
        }

        PengelolaanLaporanMasuk::create($payload);

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = PengelolaanLaporanMasuk::findOrFail($id);

        $payload = $request->only([
            'tanggal', 'belum_terverifikasi', 'terdisposisi_belum_tindak_lanjut',
            'terdisposisi_sedang_proses', 'terdisposisi_selesai', 'tertunda'
        ]);

        if ($request->hasFile('gambar')) {
            if ($data->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($data->gambar);
            }
            $payload['gambar'] = $request->file('gambar')->store('pengelolaan_laporan_masuk', 'public');
        }

        if ($request->hasFile('dokumen')) {
            if ($data->dokumen && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->dokumen)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($data->dokumen);
            }
            $payload['dokumen'] = $request->file('dokumen')->store('pengelolaan_laporan_masuk', 'public');
        }

        $data->update($payload);

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PengelolaanLaporanMasuk::findOrFail($id);

        if ($data->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($data->gambar);
        }
        if ($data->dokumen && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->dokumen)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($data->dokumen);
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}
