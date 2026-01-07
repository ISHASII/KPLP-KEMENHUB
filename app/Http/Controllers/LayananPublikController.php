<?php

namespace App\Http\Controllers;

use App\Models\LayananPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananPublikController extends Controller
{
    public function index()
    {
        $allData = LayananPublik::orderBy('tanggal', 'desc')->get();

        return view('layanan_publik', compact('allData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'penyidikan_penyelidikan' => 'nullable|integer|min:0',
            'patroli_kapal' => 'nullable|integer|min:0',
            'sar' => 'nullable|integer|min:0',
            'snbp' => 'nullable|integer|min:0',
            'pengawasan_salvage' => 'nullable|integer|min:0',
            'marpol' => 'nullable|integer|min:0',
            'tamu_kantor' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('layanan_publik', 'public');
        }

        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('layanan_publik', 'public');
        }

        LayananPublik::create([
            'tanggal' => $request->tanggal,
            'penyidikan_penyelidikan' => $request->penyidikan_penyelidikan ?: 0,
            'patroli_kapal' => $request->patroli_kapal ?: 0,
            'sar' => $request->sar ?: 0,
            'snbp' => $request->snbp ?: 0,
            'pengawasan_salvage' => $request->pengawasan_salvage ?: 0,
            'marpol' => $request->marpol ?: 0,
            'tamu_kantor' => $request->tamu_kantor ?: 0,
            'gambar' => $gambarPath,
            'dokumen' => $dokumenPath,
        ]);

        return redirect()->back()->with('success', 'Data Layanan Publik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = LayananPublik::findOrFail($id);
        return view('layanan_publik', compact('data')); // tetap pakai view yang sama, nanti di blade bedain pakai @if
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'penyidikan_penyelidikan' => 'nullable|integer|min:0',
            'patroli_kapal' => 'nullable|integer|min:0',
            'sar' => 'nullable|integer|min:0',
            'snbp' => 'nullable|integer|min:0',
            'pengawasan_salvage' => 'nullable|integer|min:0',
            'marpol' => 'nullable|integer|min:0',
            'tamu_kantor' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $layanan = LayananPublik::findOrFail($id);

        $updateData = $request->only([
            'tanggal',
            'penyidikan_penyelidikan',
            'patroli_kapal',
            'sar',
            'snbp',
            'pengawasan_salvage',
            'marpol',
            'tamu_kantor'
        ]);

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar) {
                Storage::disk('public')->delete($layanan->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('layanan_publik', 'public');
        }

        if ($request->hasFile('dokumen')) {
            if ($layanan->dokumen) {
                Storage::disk('public')->delete($layanan->dokumen);
            }
            $updateData['dokumen'] = $request->file('dokumen')->store('layanan_publik', 'public');
        }

        $layanan->update($updateData);

        return redirect('/layanan-publik')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = LayananPublik::findOrFail($id);

        if ($layanan->gambar) {
            Storage::disk('public')->delete($layanan->gambar);
        }
        if ($layanan->dokumen) {
            Storage::disk('public')->delete($layanan->dokumen);
        }

        $layanan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
