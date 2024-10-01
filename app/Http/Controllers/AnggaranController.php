<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        $anggaran = Anggaran::all();
        return view('admin.anggaran.index', ['anggaran' => $anggaran]);
    }

    public function create()
    {
        return view('admin.anggaran.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dana_masuk' => 'required|numeric',
            'dana_keluar' => 'required|numeric',
        ]);

        // Hitung total_dana
        $total_dana = $request->dana_masuk - $request->dana_keluar;

        // Simpan data anggaran baru
        Anggaran::create([
            'dana_masuk' => $request->dana_masuk,
            'dana_keluar' => $request->dana_keluar,
            'total_dana' => $total_dana,
        ]);

        return redirect()->route('anggaran.index')->with('success', 'Data added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dana_masuk' => 'required|numeric',
            'dana_keluar' => 'required|numeric',
        ]);

        // Hitung total_dana
        $total_dana = $request->dana_masuk - $request->dana_keluar;

        // Temukan dan update data anggaran yang ada
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->update([
            'dana_masuk' => $request->dana_masuk,
            'dana_keluar' => $request->dana_keluar,
            'total_dana' => $total_dana,
        ]);

        return redirect()->route('anggaran.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return redirect()->route('anggaran.index')->with('success', 'Data deleted successfully.');
    }

    public function updateDanaMasuk()
    {
        // Menjumlahkan semua dana_masuk dari tabel Anggaran
        $totalDanaMasuk = Anggaran::sum('dana_masuk');
        $anggaran = Anggaran::first();

        if ($anggaran) {
            // Update dana_masuk dan total_dana untuk record pertama (atau sesuai kebutuhan)
            $anggaran->dana_masuk = $totalDanaMasuk;
            $anggaran->total_dana = $totalDanaMasuk - $anggaran->dana_keluar;
            $anggaran->save();
        }
    }
}
