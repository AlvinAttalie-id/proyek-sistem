<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\KodeBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = DataBarang::query();

        // Filter by tanggal_awal and tanggal_akhir
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $barang = $query->paginate(10);
        $kodeBarang = KodeBarang::all();

        if ($request->has('report')) {
            return view('admin.barang.report', ['barang' => $barang]);
        }

        return view('admin.barang.index', compact('barang', 'kodeBarang'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_barang' => 'required|exists:kode_barang,id',
            'nama_barang' => 'required|string',
            'harga_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer',
            'tanggal' => 'required|date',
            // 'status' tidak perlu divalidasi dari request
        ]);

        $dataBarang = new DataBarang();
        $dataBarang->kode_barang = $request->kode_barang;
        $dataBarang->nama_barang = $request->nama_barang;
        $dataBarang->harga_barang = $request->harga_barang;
        $dataBarang->jumlah_barang = $request->jumlah_barang;
        $dataBarang->tanggal = $request->tanggal;

        // Set status to 'not available' if jumlah_barang is less than 10
        $dataBarang->status = $request->jumlah_barang < 10 ? 'not available' : 'available';

        $dataBarang->save();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dataBarang = DataBarang::findOrFail($id);
        $kodeBarang = KodeBarang::all(); // Assuming your model is named KodeBarang
        return view('barang.edit', compact('dataBarang', 'kodeBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|exists:kode_barang,id',
            'nama_barang' => 'required|string',
            'harga_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer',
            'tanggal' => 'required|date',
            // 'status' tidak perlu divalidasi dari request
        ]);

        $barang = DataBarang::findOrFail($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->tanggal = $request->tanggal;

        // Set status to 'not available' if jumlah_barang is less than 10
        $barang->status = $request->jumlah_barang < 10 ? 'not available' : 'available';

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = DataBarang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }
}
