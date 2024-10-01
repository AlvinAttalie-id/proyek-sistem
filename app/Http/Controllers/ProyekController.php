<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\DataBarang;
use App\Models\AnggaranKeluar;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $query = Proyek::query();
        // Filter by tanggal_awal and tanggal_akhir
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $proyek = $query->paginate(10);
        $barang = DataBarang::all();

        if ($request->has('report')) {
            return view('admin.proyek.report', ['proyek' => $proyek]);
        }

        return view('admin.proyek.index', compact('proyek', 'barang'));
    }

    public function report($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('admin.proyek.report1', compact('proyek'));
    }

    public function detail($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('admin.proyek.detail', compact('proyek'));
    }

    public function create()
    {
        return view('proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_proyek' => 'required|string',
            'nama_proyek' => 'required|string',
            'penanggung_jawab' => 'required|string',
            'bidang' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        // Buat array data proyek, tambahkan 'status' => 'verifikasi'
        $data = $request->all();
        $data['harga'] = '1000000';
        $data['total_harga'] = '0';
        $data['status'] = 'Available';

        // Buat proyek baru
        $proyek = Proyek::create($data);

        // Setelah proyek dibuat, buat entri baru di tabel anggaran_keluar
        AnggaranKeluar::create([
            'kode_proyek' => $proyek->kode_proyek,
            'tanggal_keluar' => $proyek->tanggal,
            'jumlah_keluar' => $proyek->total_harga, // Menggunakan total_harga dari proyek
            'keterangan' => $proyek->keterangan,
            'status' => 'verifikasi', // Status default
        ]);

        return redirect()->route('proyek.index')->with('success', 'Data added successfully.');
    }

    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('proyek.edit', ['proyek' => $proyek]);
    }

    public function update(Request $request, $id)
    {
        // Validasi permintaan berdasarkan apakah berasal dari view 'projec' atau 'monitor'
        if ($request->has('update_type') && $request->update_type === 'projec') {
            $request->validate([
                'kode_proyek' => 'required|string',
                'nama_proyek' => 'required|string',
                'penanggung_jawab' => 'required|string',
                'bidang' => 'required|string',
                'keterangan' => 'required|string',
            ]);

            $proyek = Proyek::findOrFail($id);
            $proyek->update($request->only(['kode_proyek', 'nama_proyek', 'penanggung_jawab', 'bidang', 'keterangan']));

            return redirect()->route('proyek.index')->with('success', 'Data updated successfully.');
        } elseif ($request->has('update_type') && $request->update_type === 'monitor') {
            $request->validate([
                'nama_barang' => 'required|string',
                'jumlah' => 'required|integer',
                'harga' => 'required|numeric', // Validasi untuk harga
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
            ]);

            $proyek = Proyek::findOrFail($id);
            $proyek->nama_barang = $request->nama_barang;
            $proyek->jumlah = $request->jumlah;
            $proyek->harga = $request->harga;

            // Hitung total_harga
            $proyek->total_harga = $request->jumlah * $request->harga;

            // Jika ada file foto yang diupload, proses file tersebut
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $imageData = file_get_contents($file); // Mendapatkan data biner dari file
                $proyek->foto = $imageData; // Menyimpan data biner ke dalam kolom longblob
            }

            // Cek apakah semua field yang dibutuhkan telah diisi
            if ($proyek->nama_barang && $proyek->jumlah && $proyek->foto) {
                $proyek->status = 'Done'; // Ubah status menjadi Done
            }

            $proyek->save();

            return redirect()->route('proyek.index')->with('success', 'Data updated successfully.');
        }

        // Jika tidak ada update_type, kembalikan error
        return redirect()->back()->with('error', 'Invalid update request.');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);

        // Cari dan hapus anggaran keluar yang terkait dengan proyek ini
        AnggaranKeluar::where('kode_proyek', $proyek->kode_proyek)->delete();

        // Setelah menghapus anggaran keluar, hapus proyek
        $proyek->delete();

        return redirect()->route('proyek.index')->with('success', 'Data deleted successfully.');
    }
}
