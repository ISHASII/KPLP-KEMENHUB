<?php

namespace App\Http\Controllers;

use App\Models\LayananPublik;
use Illuminate\Http\Request;

class LayananPublikController extends Controller
{
    public function index()
    {
        $allData = LayananPublik::orderBy('tanggal', 'desc')->get();

        // atau kalau mau paginasi:
        // $allData = LayananPublik::orderBy('tanggal', 'desc')->paginate(15);

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
        ]);

        LayananPublik::create([
            'tanggal' => $request->tanggal,
            'penyidikan_penyelidikan' => $request->penyidikan_penyelidikan ?: 0,
            'patroli_kapal' => $request->patroli_kapal ?: 0,
            'sar' => $request->sar ?: 0,
            'snbp' => $request->snbp ?: 0,
            'pengawasan_salvage' => $request->pengawasan_salvage ?: 0,
            'marpol' => $request->marpol ?: 0,
            'tamu_kantor' => $request->tamu_kantor ?: 0,
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
        ]);

        $layanan = LayananPublik::findOrFail($id);
        $layanan->update($request->only([
            'tanggal',
            'penyidikan_penyelidikan',
            'patroli_kapal',
            'sar',
            'snbp',
            'pengawasan_salvage',
            'marpol',
            'tamu_kantor'
        ]));

        return redirect('/layanan-publik')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        LayananPublik::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
