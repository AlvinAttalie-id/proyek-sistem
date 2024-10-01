<?php

namespace App\Http\Controllers;

use App\Models\Skm;
use Illuminate\Http\Request;

class SkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Skm::query();

        // Filter by tanggal_awal and tanggal_akhir
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_awal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $skm = $query->paginate(10);

        if ($request->has('report')) {
            return view('admin.skm.report', ['skm' => $skm]);
        }

        return view('admin.skm.index', ['skm' => $skm]);
    }

    public function create()
    {
        return view('admin.skm.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nilai1' => 'required|numeric',
            'nilai2' => 'required|numeric',
            'nilai3' => 'required|numeric',
            'keterangan' => 'required|string',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Menghitung total_nilai sebagai jumlah dari nilai1, nilai2, dan nilai3
        $total_nilai = $request->nilai1 + $request->nilai2 + $request->nilai3;

        // Menyimpan data baru ke tabel SKM
        Skm::create([
            'nilai1' => $request->nilai1,
            'nilai2' => $request->nilai2,
            'nilai3' => $request->nilai3,
            'total_nilai' => $total_nilai,
            'keterangan' => $request->keterangan,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect()->route('skm.index')->with('success', 'Data added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai1' => 'required|numeric',
            'nilai2' => 'required|numeric',
            'nilai3' => 'required|numeric',
            'keterangan' => 'required|string',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Menghitung total_nilai sebagai jumlah dari nilai1, nilai2, dan nilai3
        $total_nilai = $request->nilai1 + $request->nilai2 + $request->nilai3;

        // Temukan dan update data SKM yang ada
        $skm = Skm::findOrFail($id);
        $skm->update([
            'nilai1' => $request->nilai1,
            'nilai2' => $request->nilai2,
            'nilai3' => $request->nilai3,
            'total_nilai' => $total_nilai,
            'keterangan' => $request->keterangan,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect()->route('skm.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $skm = Skm::findOrFail($id);
        $skm->delete();

        return redirect()->route('skm.index')->with('success', 'Data deleted successfully.');
    }

    public function updateTotalNilai()
    {
        // Menjumlahkan total_nilai dari semua record di tabel SKM
        $totalNilaiSemua = Skm::sum('total_nilai');
        $skm = Skm::first();

        if ($skm) {
            // Update total_nilai untuk record pertama (atau sesuai kebutuhan)
            $skm->total_nilai = $totalNilaiSemua;
            $skm->save();
        }
    }
}
