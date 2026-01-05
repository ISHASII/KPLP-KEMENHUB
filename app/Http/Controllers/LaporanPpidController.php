<?php

namespace App\Http\Controllers;

use App\Models\LaporanPpid;
use Illuminate\Http\Request;

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
        ]);

        LaporanPpid::create([
            'tanggal' => $request->tanggal,
            'jumlah_pemohon' => $request->jumlah_pemohon,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_pemohon' => 'required|integer|min:0',
        ]);

        $laporan = LaporanPpid::findOrFail($id);

        $laporan->update([
            'tanggal' => $request->tanggal,
            'jumlah_pemohon' => $request->jumlah_pemohon,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus satu data
    public function destroy($id)
    {
        LaporanPpid::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}