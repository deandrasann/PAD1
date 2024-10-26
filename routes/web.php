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

Route::group(['middleware' => ['level:admin,dokter,apoteker,pengawas']], function () {

    Route::get('/obat', [DashboardController::class, 'obat'])->name('daftar-obat');
    Route::get('/tambah-resep', [DashboardController::class, 'tambahResep'])->name('tambah-resep');
    Route::get('/beranda', [DashboardController::class, 'beranda'])->name('beranda');
    Route::get('/resep-pasien', [DashboardController::class, 'resepTiapPasien'])->name('resep-tiap-pasien');
    Route::get('/detail-resep-obat',[DashboardController::class, 'detailDataObat'])->name('detail-resep-obat');
    Route::get('/riwayat-resep',[DashboardController::class, 'riwayatResep'])->name('riwayat-resep');

});


