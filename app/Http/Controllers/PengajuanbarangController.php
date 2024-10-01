<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanbarang;
use App\Models\BarangKeluar;
use App\Models\DataBarang;
use App\Models\KodeBarang; 
use App\Models\DataSupplier;
use Illuminate\Http\Request;

class PengajuanbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
           return view('admin.pengajuan-barang.report', ['barangKeluar' => $barangKeluar]);
       }
        return view('admin.pengajuan-barang.index', compact('barangKeluar', 'barang', 'dataSupplier' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuanbarang $pengajuanbarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuanbarang $pengajuanbarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuanbarang $pengajuanbarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuanbarang $pengajuanbarang)
    {
        //
    }
}
