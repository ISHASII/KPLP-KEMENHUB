<?php

namespace App\Http\Controllers;

use App\Models\LaporanSkm;
use Illuminate\Http\Request;

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
        ]);

        LaporanSkm::create([
            'tanggal' => $request->tanggal,
            'responden' => $request->responden,
            'ipk' => $request->ipk,
            'ikm' => $request->ikm,
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
        ]);

        $laporan = LaporanSkm::findOrFail($id);
        
        $laporan->update([
            'tanggal' => $request->tanggal,
            'responden' => $request->responden,
            'ipk' => $request->ipk,
            'ikm' => $request->ikm,
        ]);

        return redirect()->back()->with('success', 'Data SKM berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        LaporanSkm::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}