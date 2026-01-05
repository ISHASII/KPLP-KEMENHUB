<?php

namespace App\Http\Controllers;

use App\Models\LaporanMediaVisual;
use Illuminate\Http\Request;

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
        ]);

        LaporanMediaVisual::create([
            'tanggal' => $request->tanggal,
            'tayangan_postingan' => $request->tayangan_postingan,
            'pengikut' => $request->pengikut,
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
        ]);

        $laporan = LaporanMediaVisual::findOrFail($id);
        
        $laporan->update([
            'tanggal' => $request->tanggal,
            'tayangan_postingan' => $request->tayangan_postingan,
            'pengikut' => $request->pengikut,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        LaporanMediaVisual::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}