<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use Database\Seeders\PasienSeeder;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['level:admin,dokter,apoteker,pengawas,pasien']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/pasien-terdaftar', [PasienController::class, 'index'])->name('pasien-terdaftar');



Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::get('/password-verification', function () {
    return view('new-pass-verification');
});

Route::get('/pasien', [DashboardController::class, 'pasien'])->name('daftar-pasien');

Route::group(['middleware' => ['auth','level:admin,dokter,apoteker,pengawas']], function () {

    Route::get('/obat', [DashboardController::class, 'obat'])->name('daftar-obat');
    Route::delete('/obat/{id}', [DashboardController::class, 'obatdestroy'])->name('obat.destroy');
    Route::get('/tambah-resep', [DashboardController::class, 'tambahResep'])->name('tambah-resep');
    Route::get('/beranda', [DashboardController::class, 'beranda'])->name('beranda');
    Route::get('/resep-pasien/{id}', [DashboardController::class, 'resepTiapPasien'])->name('resep-tiap-pasien');
    Route::post('/resep-pasien', [DashboardController::class, 'store'])->name('reseptiappasien.store');
    Route::get('/detail-resep-obat',[DashboardController::class, 'detailDataObat'])->name('detail-resep-obat');
    Route::get('/riwayat-resep',[DashboardController::class, 'riwayatResep'])->name('riwayat-resep');
    Route::get('/jumlah-apoteker',[DashboardController::class, 'jumlahApoteker'])->name('jumlah-apoteker');
    Route::delete('/resep-pasien/{id}',[DashboardController::class, 'destroy'])->name('resep.destroy');
    Route::get('/jumlah-pengawas',[DashboardController::class, 'jumlahPengawas'])->name('jumlah-pengawas');
    Route::delete('/resep-pasien/{id}',[DashboardController::class, 'destroy'])->name('resep.destroy');
    Route::get('/tambah-apoteker',[DashboardController::class, 'tambahApoteker'])->name('tambah-apoteker');
    Route::get('/pasien-pmo',[DashboardController::class, 'pasienPMO'])->name('pmo-daftar-pasien');
    Route::get('/cek-pasien',[DashboardController::class, 'cekpasienPMO'])->name('pmo-cek-pasien');
    Route::get('/data-resep',[DashboardController::class, 'dataResepPMO'])->name('pmo-data-resep');
    Route::get('/riwayat-minum-obat', [DashboardController::class, 'riwayatMinumObat'])->name('pmo-riwayat-minum-obat');
    Route::get('/riwayat-pasien', [DashboardController::class, 'riwayatPasienPMO'])->name('riwayat-pasien-PMO');
    Route::get('/riwayat-data-resep', [DashboardController::class, 'riwayatDataResep'])->name('riwayat-data-resep');
    Route::get('/riwayat-minum-obat-2', [DashboardController::class, 'riwayatMinumObat2'])->name('riwayat-minum-obat-2');

});


