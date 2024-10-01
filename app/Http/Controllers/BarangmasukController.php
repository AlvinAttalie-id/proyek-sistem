<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DataBarang;
use App\Models\KodeBarang;
use App\Models\DataSupplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangMasuk::query();

        // Filter by date range
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $barangMasuk = $query->paginate(10);
        $barang = DataBarang::all();
        $dataSupplier = DataSupplier::all();
        $kodeBarang = KodeBarang::all();

        if ($request->has('report')) {
            return view('admin.barang-masuk.report', ['barangMasuk' => $barangMasuk]);
        }

        return view('admin.barang-masuk.index', compact('barangMasuk', 'barang', 'dataSupplier', 'kodeBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'nama_barang' => 'required|exists:data-barang,id',
            'nama_supplier' => 'required|exists:data-suplier,id',
            'jumlah_masuk' => 'required|integer',
            'tanggal' => 'required|date',
            // Tidak perlu memvalidasi status karena kita menetapkan nilai secara langsung
        ]);

        $dataMasuk = new BarangMasuk();
        $dataMasuk->kode_barang = $request->kode_barang;
        $dataMasuk->nama_barang = $request->nama_barang;
        $dataMasuk->nama_supplier = $request->nama_supplier;
        $dataMasuk->jumlah_masuk = $request->jumlah_masuk;
        $dataMasuk->tanggal = $request->tanggal;
        $dataMasuk->status = 'Verifikasi'; // Selalu set status menjadi 'verifikasi'
        $dataMasuk->save();

        // Update jumlah_barang di tabel DataBarang
        $barang = DataBarang::find($request->nama_barang);
        $barang->jumlah_barang += $request->jumlah_masuk;

        // Set status to 'not available' if jumlah_barang is less than 10
        $barang->status = $barang->jumlah_barang < 10 ? 'not available' : 'available';
        $barang->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Data added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'nama_barang' => 'required|exists:data-barang,id',
            'nama_supplier' => 'required|exists:data-suplier,id',
            'jumlah_masuk' => 'required|integer',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        // Update jumlah_barang di tabel DataBarang
        $oldJumlah = $barangMasuk->jumlah_masuk;
        $barang = DataBarang::find($barangMasuk->nama_barang);
        $barang->jumlah_barang -= $oldJumlah;
        $barang->jumlah_barang += $request->jumlah_masuk;
        $barang->save();

        $barangMasuk->update($request->all());

        return redirect()->route('barang-masuk.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Update jumlah_barang di tabel DataBarang
        $barang = DataBarang::find($barangMasuk->nama_barang);
        $barang->jumlah_barang -= $barangMasuk->jumlah_masuk;
        $barang->save();

        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')->with('success', 'Data deleted successfully.');
    }
}
