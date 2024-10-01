<?php

namespace App\Http\Controllers;

use App\Models\AnggaranMasuk;
use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranMasukController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi Pencarian Berdasarkan kode_proyek
        $query = AnggaranMasuk::query();

        // Filter berdasarkan kode_proyek
        if ($request->has('search')) {
            $query->where('kode_proyek', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan rentang tanggal
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_masuk', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $anggaranMasuk = $query->paginate(5);

        // Jika request memiliki parameter 'report', render tampilan laporan
        if ($request->has('report')) {
            return view('admin.anggaran-masuk.report', ['anggaranMasuk' => $anggaranMasuk]);
        }

        return view('admin.anggaran-masuk.index', ['anggaranMasuk' => $anggaranMasuk]);
    }

    // Modal Add Function
    public function store(Request $request)
    {
        $request->validate([
            'kode_proyek' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|numeric',
            'keterangan' => 'nullable|string', // Keterangan opsional
        ]);

        // Menyimpan data anggaran masuk baru dengan status otomatis "verifikasi"
        $anggaranMasuk = AnggaranMasuk::create([
            'kode_proyek' => $request->kode_proyek,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'status' => 'verifikasi', // Set status otomatis ke "verifikasi"
            'keterangan' => $request->keterangan, // Menyimpan keterangan
        ]);

        // Menambah nilai `jumlah_masuk` ke `dana_masuk` dan `total_dana` di tabel `anggaran`
        $anggaran = Anggaran::first();
        if ($anggaran) {
            $anggaran->dana_masuk += $anggaranMasuk->jumlah_masuk;
            $anggaran->total_dana += $anggaranMasuk->jumlah_masuk;
            $anggaran->save();
        } else {
            // Jika tidak ada data di tabel anggaran, buat data baru
            Anggaran::create([
                'dana_masuk' => $anggaranMasuk->jumlah_masuk,
                'dana_keluar' => 0,
                'total_dana' => $anggaranMasuk->jumlah_masuk,
            ]);
        }

        return redirect()->route('anggaran-masuk.index')->with('success', 'Data added successfully.');
    }

    public function show($id)
    {
        $anggaranMasuk = AnggaranMasuk::findOrFail($id);
        return view('admin.anggaran-masuk.show', ['anggaranMasuk' => $anggaranMasuk]);
    }

    public function edit($id)
    {
        $anggaranMasuk = AnggaranMasuk::findOrFail($id);
        return view('admin.anggaran-masuk.edit', ['anggaranMasuk' => $anggaranMasuk]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_proyek' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|numeric',
            'status' => 'required|string',
            'keterangan' => 'nullable|string', // Keterangan opsional
        ]);

        $anggaranMasuk = AnggaranMasuk::findOrFail($id);

        // Kurangi nilai `jumlah_masuk` sebelumnya dari `dana_masuk` dan `total_dana`
        $anggaran = Anggaran::first();
        if ($anggaran) {
            $anggaran->dana_masuk -= $anggaranMasuk->jumlah_masuk;
            $anggaran->total_dana -= $anggaranMasuk->jumlah_masuk;
        }

        // Update data anggaran masuk
        $anggaranMasuk->update([
            'kode_proyek' => $request->kode_proyek,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'status' => $request->status,
            'keterangan' => $request->keterangan, // Update keterangan
        ]);

        // Tambahkan nilai `jumlah_masuk` baru ke `dana_masuk` dan `total_dana`
        if ($anggaran) {
            $anggaran->dana_masuk += $anggaranMasuk->jumlah_masuk;
            $anggaran->total_dana += $anggaranMasuk->jumlah_masuk;
            $anggaran->save();
        }

        return redirect()->route('anggaran-masuk.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $anggaranMasuk = AnggaranMasuk::findOrFail($id);

        // Kurangi nilai `jumlah_masuk` dari `dana_masuk` dan `total_dana`
        $anggaran = Anggaran::first();
        if ($anggaran) {
            $anggaran->dana_masuk -= $anggaranMasuk->jumlah_masuk;
            $anggaran->total_dana -= $anggaranMasuk->jumlah_masuk;
            $anggaran->save();
        }

        $anggaranMasuk->delete();

        return redirect()->route('anggaran-masuk.index')->with('success', 'Data deleted successfully.');
    }
}
