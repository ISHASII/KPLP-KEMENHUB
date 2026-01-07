<?php

namespace App\Http\Controllers;

use App\Models\LaporanSiaranPers;
use Illuminate\Http\Request;

class LaporanSiaranPersController extends Controller
{
    public function index()
    {
        $data = LaporanSiaranPers::orderBy('tanggal', 'desc')->get();
        return view('laporan_pers', compact('data')); // Ganti ke 'laporan_pers'
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_siaran_pers' => 'required|integer|min:0',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $payload = $request->only(['jumlah_siaran_pers', 'tanggal']);

        if ($request->hasFile('gambar')) {
            $payload['gambar'] = $request->file('gambar')->store('laporan_siaran_pers', 'public');
        }

        if ($request->hasFile('dokumen')) {
            $payload['dokumen'] = $request->file('dokumen')->store('laporan_siaran_pers', 'public');
        }

        LaporanSiaranPers::create($payload);

        return back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_siaran_pers' => 'required|integer|min:0',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = LaporanSiaranPers::findOrFail($id);

        $payload = $request->only(['jumlah_siaran_pers', 'tanggal']);

        // Handle gambar
        if ($request->hasFile('gambar')) {
            // delete old
            if ($data->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($data->gambar);
            }
            $payload['gambar'] = $request->file('gambar')->store('laporan_siaran_pers', 'public');
        }

        // Handle dokumen
        if ($request->hasFile('dokumen')) {
            if ($data->dokumen && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->dokumen)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($data->dokumen);
            }
            $payload['dokumen'] = $request->file('dokumen')->store('laporan_siaran_pers', 'public');
        }

        $data->update($payload);

        return back()->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = LaporanSiaranPers::findOrFail($id);

        // delete files if exist
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
