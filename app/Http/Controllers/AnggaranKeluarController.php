<?php

namespace App\Http\Controllers;

use App\Models\AnggaranKeluar;
use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranKeluarController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi Pencarian Berdasarkan kode_proyek
        $query = AnggaranKeluar::query();

        // Filter berdasarkan kode_proyek
        if ($request->has('search')) {
            $query->where('kode_proyek', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan rentang tanggal
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_keluar', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $anggaranKeluar = $query->paginate(5);

        // Jika request memiliki parameter 'report', render tampilan laporan
        if ($request->has('report')) {
            return view('admin.anggaran-keluar.report', ['anggaranKeluar' => $anggaranKeluar]);
        }

        return view('admin.anggaran-keluar.index', ['anggaranKeluar' => $anggaranKeluar]);
    }

    // Modal Add Function
    public function store(Request $request)
    {
        $request->validate([
            'kode_proyek' => 'required|string',
            'tanggal_keluar' => 'required|date',
            'jumlah_keluar' => 'required|numeric',
            'keterangan' => 'nullable|string', // Keterangan opsional
        ]);

        // Menyimpan data anggaran keluar baru
        $anggaranKeluar = AnggaranKeluar::create([
            'kode_proyek' => $request->kode_proyek,
            'tanggal_keluar' => $request->tanggal_keluar,
            'jumlah_keluar' => $request->jumlah_keluar,
            'status' => 'verifikasi',
            'keterangan' => $request->keterangan, // Menyimpan keterangan
        ]);

        // Menambah nilai `jumlah_keluar` ke `dana_keluar` dan mengurangi `total_dana` di tabel `anggaran`
        $anggaran = Anggaran::first();
        if ($anggaran) {
            $anggaran->dana_keluar += $anggaranKeluar->jumlah_keluar;
            $anggaran->total_dana -= $anggaranKeluar->jumlah_keluar;
            $anggaran->save();
        } else {
            // Jika tidak ada data di tabel anggaran, buat data baru
            Anggaran::create([
                'dana_masuk' => 0,
                'dana_keluar' => $anggaranKeluar->jumlah_keluar,
                'total_dana' => -$anggaranKeluar->jumlah_keluar,
            ]);
        }

        return redirect()->route('anggaran-keluar.index')->with('success', 'Data added successfully.');
    }

    public function show($id)
    {
        $anggaranKeluar = AnggaranKeluar::findOrFail($id);
        return view('admin.anggaran-keluar.show', ['anggaranKeluar' => $anggaranKeluar]);
    }

    public function edit($id)
    {
        $anggaranKeluar = AnggaranKeluar::findOrFail($id);
        return view('admin.anggaran-keluar.edit', ['anggaranKeluar' => $anggaranKeluar]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_proyek' => 'required|string',
            'tanggal_keluar' => 'required|date',
            'jumlah_keluar' => 'required|numeric',
            'keterangan' => 'nullable|string', // Keterangan opsional
            'status' => 'required|string',
            
        ]);

        $anggaranKeluar = AnggaranKeluar::findOrFail($id);

        // Kurangi nilai `jumlah_keluar` sebelumnya dari `dana_keluar` dan `total_dana`
        $anggaran = Anggaran::first();
        if ($anggaran) {
            $anggaran->dana_keluar -= $anggaranKeluar->jumlah_keluar;
            $anggaran->total_dana += $anggaranKeluar->jumlah_keluar;
        }

        // Update data anggaran keluar
        $anggaranKeluar->update([
            'kode_proyek' => $request->kode_proyek,
            'tanggal_keluar' => $request->tanggal_keluar,
            'jumlah_keluar' => $request->jumlah_keluar,
            'keterangan' => $request->keterangan, // Update keterangan
            'status' => $request->status,
            
        ]);

        // Tambahkan nilai `jumlah_keluar` baru ke `dana_keluar` dan kurangi `total_dana`
        if ($anggaran) {
            $anggaran->dana_keluar += $anggaranKeluar->jumlah_keluar;
            $anggaran->total_dana -= $anggaranKeluar->jumlah_keluar;
            $anggaran->save();
        }

        return redirect()->route('anggaran-keluar.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $anggaranKeluar = AnggaranKeluar::findOrFail($id);

        // Kurangi nilai `jumlah_keluar` dari `dana_keluar` dan tambahkan ke `total_dana`
        $anggaran = Anggaran::first();
        if ($anggaran) {
            $anggaran->dana_keluar -= $anggaranKeluar->jumlah_keluar;
            $anggaran->total_dana += $anggaranKeluar->jumlah_keluar;
            $anggaran->save();
        }

        $anggaranKeluar->delete();

        return redirect()->route('anggaran-keluar.index')->with('success', 'Data deleted successfully.');
    }
}
