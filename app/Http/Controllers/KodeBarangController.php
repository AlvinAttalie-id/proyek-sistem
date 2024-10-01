<?php

namespace App\Http\Controllers;

use App\Models\KodeBarang;
use Illuminate\Http\Request;

class KodeBarangController extends Controller
{
    public function index()
    {
        $kodeBarang = KodeBarang::all();
        return view('admin.kode-barang.index', ['kodeBarang' => $kodeBarang]);
    }

    public function create()
    {
        return view('admin.kode-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'jenis_barang' => 'required|string',
        ]);

        KodeBarang::create([
            'kode_barang' => $request->kode_barang,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return redirect()->route('kode-barang.index')->with('success', 'Data added successfully.');
    }

    public function show($id_barang)
    {
        $kodeBarang = KodeBarang::findOrFail($id_barang);
        return view('admin.kode-barang.show', ['kodeBarang' => $kodeBarang]);
    }

    public function edit($id_barang)
    {
        $kodeBarang = KodeBarang::findOrFail($id_barang);
        return view('admin.kode-barang.edit', ['kodeBarang' => $kodeBarang]);
    }

    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'jenis_barang' => 'required|string',
        ]);

        $kodeBarang = KodeBarang::findOrFail($id_barang);
        $kodeBarang->update([
            'kode_barang' => $request->kode_barang,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return redirect()->route('kode-barang.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        $kodeBarang = KodeBarang::findOrFail($id_barang);
        $kodeBarang->delete();

        return redirect()->route('kode-barang.index')->with('success', 'Data deleted successfully.');
    }
}
