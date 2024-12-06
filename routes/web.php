<?php

use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PengawasMinumObatController;
use App\Http\Controllers\ResepController;
use App\Models\RiwayatMinumObatModel;
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

Route::get('/beranda', [DashboardController::class, 'beranda'])->name('beranda');

Route::group(['middleware' => ['auth', 'level:admin,apoteker']], function () {

    Route::get('/pasien', [PasienController::class, 'pasien'])->name('daftar-pasien');
    Route::post('/pasien', [PasienController::class, 'PasienStore'])->name('pasien.store');
    Route::post('/pasien/{id}', [PasienController::class, 'PasienUpdate'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'PasienDestroy'])->name('pasien.destroy');
    Route::get('/hasil-scan', [PasienController::class, 'hasilScan'])->name('hasil.scan');

    Route::get('/obat', [ObatController::class, 'obat'])->name('daftar-obat');
    Route::post('/obat', [ObatController::class, 'obatstore'])->name('daftarobat.store');
    Route::post('/obat/{id}', [ObatController::class, 'obatupdate'])->name('daftarobat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'obatdestroy'])->name('obat.destroy');

    Route::get('/tambah-resep', [ResepController::class, 'tambahResep'])->name('tambah-resep');
    Route::post('/tambah-resep', [ResepController::class, 'TambahPasien'])->name('tambahpasien');
    Route::get('/resep-pasien/{id}', [ResepController::class, 'resepTiapPasien'])->name('resep-tiap-pasien');
    Route::post('/resep-pasien', [ResepController::class, 'store'])->name('reseptiappasien.store');
    Route::get('/detail-resep-obat/{id}', [ResepController::class, 'detailDataObat'])->name('detail-resep-obat');
    Route::delete('/resep-pasien/{id}', [ResepController::class, 'destroy'])->name('resep.destroy');
});

Route::group(['middleware' => ['auth', 'level:admin']], function () {
    Route::get('/jumlah-apoteker', [ApotekerController::class, 'index'])->name('jumlah-apoteker');
    Route::post('/tambah-apoteker', [ApotekerController::class, 'ApotekerStore'])->name('apoteker.store');
    Route::post('/jumlah-apoteker/{id}', [ApotekerController::class, 'ApotekerUpdate'])->name('apoteker.update');
    Route::delete('/jumlah-apoteker/{id}', [ApotekerController::class, 'ApotekerDestroy'])->name('apoteker.destroy');
    Route::get('/tambah-apoteker', [ApotekerController::class, 'tambahApoteker'])->name('tambah-apoteker');

    Route::get('/jumlah-pengawas', [PengawasController::class, 'index'])->name('jumlah-pengawas');
    Route::get('/tambah-pengawas', [PengawasController::class, 'tambahpengawas'])->name('tambah-pengawas');
    Route::post('/tambah-pengawas', [PengawasController::class, 'pengawasStore'])->name('pengawas.store');
    Route::post('/jumlah-pengawas/{id}', [PengawasController::class, 'pengawasupdate'])->name('pengawas.update');
    Route::delete('/jumlah-pengawas/{id}', [PengawasController::class, 'pengawasdestroy'])->name('pengawas.destroy');
});

Route::group(['middleware' => ['auth', 'level:admin,pengawas']], function () {

    Route::get('/riwayat-resep', [DashboardController::class, 'riwayatResep'])->name('riwayat-resep');
    Route::get('/pasien-pmo', [PengawasMinumObatController::class, 'pasienPMO'])->name('pmo-daftar-pasien');
    Route::get('/cek-pasien/{id}', [PengawasMinumObatController::class, 'cekpasienPMO'])->name('pmo-cek-pasien');
    Route::delete('/cek-pasien/{id}', [PengawasMinumObatController::class, 'pasienPMODestroy'])->name('pmo.destroy');
    Route::get('/data-resep/{id}', [PengawasMinumObatController::class, 'dataResepPMO'])->name('pmo-data-resep');
    Route::get('/riwayat-minum-obat/{id}', [PengawasMinumObatController::class, 'riwayatMinumObat'])->name('pmo-riwayat-minum-obat');
    Route::get('/riwayat-pasien', [DashboardController::class, 'riwayatPasienPMO'])->name('riwayat-pasien-PMO');
    Route::get('/riwayat-data-resep', [DashboardController::class, 'riwayatDataResep'])->name('riwayat-data-resep');
    Route::get('/riwayat-minum-obat-2', [DashboardController::class, 'riwayatMinumObat2'])->name('riwayat-minum-obat-2');
});

Route::get('/cobajadwal/{id}', [PengawasMinumObatController::class, 'cobacoba'])->name('cobaminum');