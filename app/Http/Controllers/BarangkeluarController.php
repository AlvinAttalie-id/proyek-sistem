<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DataBarang;
use App\Models\KodeBarang;
use App\Models\DataSupplier;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi Pencarian Berdasarkan kode_proyek
        $query = BarangKeluar::query();

        // Filter berdasarkan rentang tanggal
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $barangKeluar = $query->paginate(10);
        $barang = DataBarang::all();
        $dataSupplier = DataSupplier::all();

        // Jika request memiliki parameter 'report', render tampilan laporan
        if ($request->has('report')) {
            return view('admin.barang-keluar.report', ['barangKeluar' => $barangKeluar]);
        }

        return view('admin.barang-keluar.index', compact('barangKeluar', 'barang', 'dataSupplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'nama_barang' => 'required|exists:data-barang,id',
            'penanggung_jawab' => 'required|string',
            'barang_keluar' => 'required|integer',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        $dataKeluar = new BarangKeluar();
        $dataKeluar->kode_barang = $request->kode_barang;
        $dataKeluar->nama_barang = $request->nama_barang;
        $dataKeluar->penanggung_jawab = $request->penanggung_jawab;
        $dataKeluar->barang_keluar = $request->barang_keluar;
        $dataKeluar->tanggal = $request->tanggal;
        $dataKeluar->status = $request->status;
        $dataKeluar->save();

        // Update jumlah_barang di tabel DataBarang jika status 'verifikasi'
        if ($request->status === 'verifikasi') {
            $barang = DataBarang::find($request->nama_barang);
            $barang->jumlah_barang -= $request->barang_keluar;

            // Set status to 'not available' if jumlah_barang is less than 10
            $barang->status = $barang->jumlah_barang < 10 ? 'not available' : 'available';
            $barang->save();
        }

        return redirect()->route('barang-keluar.index')->with('success', 'Data added successfully.');
    }

    public function show($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        return view('admin.barang-keluar.show', ['barangKeluar' => $barangKeluar]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'nama_barang' => 'required|exists:data-barang,id',
            'penanggung_jawab' => 'required|string',
            'barang_keluar' => 'required|integer',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);
        $oldJumlah = $barangKeluar->barang_keluar;

        // Hanya update jumlah_barang jika statusnya 'verifikasi'
        if ($barangKeluar->status === 'verifikasi') {
            $barang = DataBarang::find($barangKeluar->kode_barang);
            $barang->jumlah_barang += $oldJumlah; // Kembalikan stok lama
            if ($request->status === 'verifikasi') {
                $barang->jumlah_barang -= $request->barang_keluar; // Kurangi stok baru
            }
            $barang->save();
        }

        $barangKeluar->update($request->all());

        return redirect()->route('barang-keluar.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        // Hanya update jumlah_barang jika statusnya 'verifikasi'
        if ($barangKeluar->status === 'verifikasi') {
            $barang = DataBarang::find($barangKeluar->kode_barang);
            $barang->jumlah_barang += $barangKeluar->barang_keluar;
            $barang->save();
        }

        $barangKeluar->delete();

        return redirect()->route('barang-keluar.index')->with('success', 'Data deleted successfully.');
    }

    public function verifikasi($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->status = 'verifikasi';
    
        // Kurangi stok barang di tabel DataBarang
        $barang = DataBarang::find($barangKeluar->nama_barang);
        if ($barang) {
            $barang->jumlah_barang -= $barangKeluar->barang_keluar;
    
            // Set status to 'not available' if jumlah_barang is less than 10
            $barang->status = $barang->jumlah_barang < 10 ? 'not available' : 'available';
            $barang->save();
        }
    
        $barangKeluar->save();
    
        return redirect()->route('barang-keluar.index')->with('success', 'Status berhasil diverifikasi.');
    }
    
    public function tolak($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->status = 'tolak';
        $barangKeluar->save();

        return redirect()->route('barang-keluar.index')->with('success', 'Pengajuan barang berhasil ditolak.');
    }
}
