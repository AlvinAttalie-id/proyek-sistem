<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\UserManagement;
use App\Models\BarangKeluar;
class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah proyek
        $jumlahProyek = Proyek::count();
        $totalUsers = UserManagement::count();
        $jumlahBarangDiajukan = BarangKeluar::where('status', 'diajukan')->count();
        // Data lain yang ingin ditampilkan di dashboard bisa ditambahkan di sini
        // $jumlahAnggaran = Anggaran::count();
        // $totalDanaMasuk = Anggaran::sum('jumlah_masuk');

        return view('dashboard', compact('jumlahProyek', 'totalUsers', 'jumlahBarangDiajukan'));
        
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
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
