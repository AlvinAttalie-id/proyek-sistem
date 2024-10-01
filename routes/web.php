<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AnggaranKeluarController;
use App\Http\Controllers\AnggaranMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataSupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\KodeBarangController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PengajuanBarangController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SkmController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Route::group(['middleware' => 'auth'], function () {
    // Dashboard Section
    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Section
    Route::resource('user-management', UserManagementController::class);

    // Anggaran Dana
    Route::resource('anggaran', AnggaranController::class);
    Route::resource('anggaran-masuk', AnggaranMasukController::class);
    Route::resource('anggaran-keluar', AnggaranKeluarController::class);

    // Proyek Management
    Route::resource('proyek', ProyekController::class);
    Route::resource('monitoring', MonitoringController::class);
    Route::resource('skm', SkmController::class);

    // Barang Section
    Route::resource('barang', DataBarangController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::patch('barang-keluar/{id}/verifikasi', [BarangKeluarController::class, 'verifikasi'])->name('barang-keluar.verifikasi');
    Route::patch('/barang-keluar/tolak/{id}', [BarangKeluarController::class, 'tolak'])->name('barang-keluar.tolak');

    Route::resource('pengajuan-barang', PengajuanBarangController::class);
    Route::resource('kode-barang', KodeBarangController::class);

    // Cetak Section
    Route::resource('data-supplier', DataSupplierController::class);

    // Report Section
    Route::get('proyek-report', [ProyekController::class, 'index'])->name('proyek.report');
    Route::get('proyek/{id}/report', [ProyekController::class, 'report'])->name('proyek.report');
    Route::get('proyek/{id}/detail', [ProyekController::class, 'detail'])->name('proyek.detail');
    Route::get('anggaranmasuk-report', [AnggaranMasukController::class, 'index'])->name('anggaranmasuk.report');
    Route::get('anggarankeluar-report', [AnggaranKeluarController::class, 'index'])->name('anggarankeluar.report');
    Route::get('barang-report', [DataBarangController::class, 'index'])->name('barang.report');
    Route::get('barangmasuk-report', [BarangMasukController::class, 'index'])->name('barangmasuk.report');
    Route::get('barangkeluar-report', [BarangKeluarController::class, 'index'])->name('barangkeluar.report');
    Route::get('pengajuan-report', [PengajuanBarangController::class, 'index'])->name('pengajuan.report');
    Route::get('skm-report', [SkmController::class, 'index'])->name('skm.report');
    Route::get('users-report', [UserManagementController::class, 'index'])->name('users.report');
    Route::get('datasupplier-report', [UserManagementController::class, 'index'])->name('users.report');

    // Account Pages Section
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);

    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

Route::get('/DPPPAKB', function () {
    return view('landing');
})->name('DPPPAKB');

Route::get('/detail', function () {
    return view('detail');
})->name('detail');

// Route::get('/anggaran-masuk-cetak', function () {
//     return view('anggaranmasukcetak');
// })->name('anggaran-masuk-cetak');
