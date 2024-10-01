<?php

namespace App\Http\Controllers;

use App\Models\landing;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class landingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = landing::query();

        // Filter by tanggal_awal and tanggal_akhir
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $landing = $query->paginate(10);

        if ($request->has('report')) {
            return view('admin.landing.report', ['landing' => $landing]);
        }

        return view('admin.landing.index', ['landing' => $landing]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Buat array data landing, tambahkan 'status' => 'verifikasi'
        $data = $request->all();
        $data['status'] = 'Available';

        landing::create($data);

        return redirect()->route('landing.index')->with('success', 'Data added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $landing = landing::findOrFail($id);
        return view('landing.edit', ['landing' => $landing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'required|string',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $landing = landing::findOrFail($id);
        $landing->update($request->all());

        return redirect()->route('landing.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $landing = landing::findOrFail($id);
        $landing->delete();

        return redirect()->route('landing.index')->with('success', 'Data deleted successfully.');
    }
}