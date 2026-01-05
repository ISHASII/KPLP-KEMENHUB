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
        ]);

        LaporanSiaranPers::create($request->all());

        return back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_siaran_pers' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $data = LaporanSiaranPers::findOrFail($id);
        $data->update($request->all());

        return back()->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = LaporanSiaranPers::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}