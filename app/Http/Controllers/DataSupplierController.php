<?php

namespace App\Http\Controllers;

use App\Models\DataSupplier;
use Illuminate\Http\Request;

class DataSupplierController extends Controller
{
    public function index(Request $request)
    {
        // Fungsi Pencarian Berdasarkan kode_proyek
        $query = DataSupplier::query();

        // Filter berdasarkan rentang tanggal
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_awal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }
        $dataSupplier = $query->paginate(10);

         // Jika request memiliki parameter 'report', render tampilan laporan
         if ($request->has('report')) {
            return view('admin.data-supplier.report', ['dataSupplier' => $dataSupplier  ]);
        }

        return view('admin.data-supplier.index', compact('dataSupplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:255',
            'email_supplier' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        DataSupplier::create($request->all());

        return redirect()->route('data-supplier.index')->with('success', 'Supplier created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:255',
            'email_supplier' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $supplier = DataSupplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('data-supplier.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = DataSupplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('data-supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}

