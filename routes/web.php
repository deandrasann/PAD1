<?php

use App\Http\Controllers\Api\ResepApiController;
use App\Http\Controllers\Api\ResepsionisController as ApiResepsionisController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ObatApiController;
use App\Http\Controllers\Api\PasienApiController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PengawasMinumObatController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ResepsionisController;
use App\Models\ResepsionisModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route untuk mengambil daftar provinsi
Route::get('/api/wilayah/provinces', function () {
    $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    return $response->json();
});

// Route untuk mengambil daftar kabupaten berdasarkan ID provinsi
Route::get('/api/wilayah/regencies/{provinceId}', function ($provinceId) {
    $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
    return $response->json();
});

// Route untuk mengambil daftar kecamatan berdasarkan ID kabupaten
Route::get('/api/wilayah/districts/{regencyId}', function ($regencyId) {
    $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$regencyId}.json");
    return $response->json();
});

// Route untuk mengambil daftar kelurahan berdasarkan ID kecamatan
Route::get('/api/wilayah/villages/{districtId}', function ($districtId) {
    $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$districtId}.json");
    return $response->json();
});

Route::get('/cek-session/{id}', function ($id) {
    $data = session('data_resep' . $id);
    return response()->json($data);
});

Route::get('/tambahresepsionis', [ResepsionisController::class, 'tambah'])->name('tambahrawatjalan');
Route::get('/detail', [ResepsionisController::class, 'detail'])->name('detail');

Route::group(['middleware' => ['level:admin,dokter,apoteker,pengawas,pasien']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/api/login', [AuthApiController::class, 'login'])->name('apilogin');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/api/logout', [AuthApiController::class, 'logout'])->middleware('auth')->name('apilogout');
Route::get('/pasien-terdaftar', [PasienController::class, 'index'])->name('pasien-terdaftar');



Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::get('/password-verification', function () {
    return view('new-pass-verification');
});

Route::get('/beranda', [DashboardController::class, 'beranda'])->name('beranda');
Route::get('/jadwal-minum-obat', [PasienController::class, 'jadwalMinumObat'])->name('jadwal.obat');
Route::get('/laporan-minum-obat', [PasienController::class, 'laporanMinumObat'])->name('laporan.obat');
Route::get('/riwayat-minum-obat-pasien', [PasienController::class, 'riwayatMinumObat'])->name('riwayat.minum.obat.pasien');

Route::group(['middleware' => ['auth', 'level:pasien,apoteker']], function () {
    Route::get('/hasil-scan', [PasienController::class, 'hasilScan'])->name('hasil.scan');
    Route::get('/daftar-obat', [PasienController::class, 'daftarObat'])->name('daftar-obat-pasien');
    Route::get('/detail-obat', [PasienController::class, 'detailObat'])->name('detail-obat-pasien');
    Route::get('/atur-jadwal/{id}', [PasienController::class, 'aturJadwalObat'])->name('atur-jadwal');

    Route::get('/api/pasien/hasil-scan', [PasienApiController::class, 'getPasienHasilScan'])->name('api.pasien.hasil-scan');
    Route::get('/api/pasien/daftar-obat', [PasienApiController::class, 'getDaftarObat'])->name('api.pasien.daftar-obat');
    Route::get('/api/pasien/obat-detail/{id}', [PasienApiController::class, 'getObatDetail'])->name('api.pasien.obat-detail');
    Route::post('/api/pasien/simpan-jadwal-minum', [PasienApiController::class, 'simpanJadwalMinum'])->name('api.pasien.simpan-jadwal-minum');
    Route::get('/api/pasien/profile', [PasienApiController::class, 'getProfile'])->name('api.pasien.profile');
    Route::put('/api/pasien/jadwal-minum/{id}', [PasienApiController::class, 'updateJadwalMinumStatus'])->name('api.pasien.update-jadwal-minum-status');
});


Route::group(['middleware' => ['auth', 'level:admin,apoteker,dokter,resepsionis']], function () {

    Route::get('/pasien', [PasienController::class, 'pasien'])->name('daftar-pasien');
    Route::post('/pasien', [PasienController::class, 'PasienStore'])->name('pasien.store');
    Route::post('/pasien/{id}', [PasienController::class, 'PasienUpdate'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'PasienDestroy'])->name('pasien.destroy');


    Route::get('/api/pasien/get', [PasienApiController::class, 'getPasien'])->name('api.pasien.get');
    Route::post('/api/pasien/create', [PasienApiController::class, 'createPasien'])->name('api.pasien.create');
    Route::put('/api/pasien/update/{id_pasien}', [PasienApiController::class, 'updatePasien'])->name('api.pasien.update');
    Route::delete('/api/pasien/delete/{id_pasien}', [PasienApiController::class, 'deletePasien'])->name('api.pasien.destroy');
    Route::get('/api/pasien/get/{id_pasien}', [PasienApiController::class, 'getPasienById'])->name('api.pasien.get.id');
    Route::get('/api/pasien/get/byPemeriksaanAwal/{id_pasien}', [PasienApiController::class, 'getPasienByIdPemeriksaanAwal'])->name('api.pasien.get.id.pemeriksaanAwal');
    Route::get('/api/pasien/get/byPemeriksaanAkhir/{id_pasien}', [PasienApiController::class, 'getPasienByIdPemeriksaanAkhir'])->name('api.pasien.get.id.pemeriksaanAkhir');


    Route::get('/obat', [ObatController::class, 'obat'])->name('daftar-obat');
    Route::post('/obat', [ObatController::class, 'obatstore'])->name('daftarobat.store');
    Route::post('/obat/{id}', [ObatController::class, 'obatupdate'])->name('daftarobat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'obatdestroy'])->name('obat.destroy');

    Route::get('/api/obat/get', [ObatApiController::class, 'getObat'])->name('api.obat.get');
    Route::post('/api/obat/create', [ObatApiController::class, 'createObat'])->name('api.obat.create');
    Route::put('/api/obat/update/{kode_obat}', [ObatApiController::class, 'updateObat'])->name('api.obat.update');
    Route::delete('/api/obat/delete/{kode_obat}', [ObatApiController::class, 'destroyObat'])->name('api.obat.destroy');

    Route::get('/api/resep/get', [ResepApiController::class, 'getResep'])->name('api.resep.get');
    Route::get('/api/resep/pasien/{id}', [ResepApiController::class, 'getResepPasien'])->name('api.resep.pasien.get');
    Route::put('/api/resep/pasien/status-penyerahan/{id}', [ResepApiController::class, 'editStatusPenyerahan'])->name('api.resep.status-penyerahan.update');


    Route::get('/tambah-resep', [ResepController::class, 'tambahResep'])->name('tambah-resep');
    Route::post('/tambah-resep', [ResepController::class, 'TambahPasien'])->name('tambahpasien');
    Route::get('/resep-pasien/{id}', [ResepController::class, 'resepTiapPasien'])->name('resep-tiap-pasien');
    Route::get('/resep/get-dosis', [ResepController::class, 'getDosis'])->name('resep.get-dosis');
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

    Route::get('/jumlah-resepsionis', [ResepsionisController::class, 'index'])->name('jumlah-resepsionis');
    Route::get('/tambah-resepsionis', [ResepsionisController::class, 'tambahResepsionis'])->name('tambah-resepsionis');

    Route::get('/jumlah-dokter', [DokterController::class, 'index'])->name('jumlah-dokter');
    Route::get('/tambah-dokter', [DokterController::class, 'tambahDokter'])->name('tambah-dokter');

    Route::get('/jumlah-pasien', [PasienController::class, 'indexAdmin'])->name('jumlah-pasien');
    Route::get('/tambah-pasien', [PasienController::class, 'tambahPasien'])->name('tambah-pasien');

    // Admin API
    Route::get('/api/admin/apoteker/get', [AdminController::class, 'getApoteker'])->name('api.get.apoteker');
    Route::post('/api/admin/apoteker/create', [AdminController::class, 'createApoteker'])->name('api.create.apoteker');
    Route::put('/api/admin/apoteker/update/{id}', [AdminController::class, 'updateApoteker'])->name('api.update.apoteker');
    Route::delete('/api/admin/apoteker/delete/{id}', [AdminController::class, 'deleteApoteker'])->name('api.delete.apoteker');

    Route::get('/api/admin/pengawas/get', [AdminController::class, 'getPengawas'])->name('api.get.pengawas');
    Route::post('/api/admin/pengawas/create', [AdminController::class, 'createPengawas'])->name('api.create.pengawas');
    Route::put('/api/admin/pengawas/update/{id}', [AdminController::class, 'updatePengawas'])->name('api.update.pengawas');
    Route::delete('/api/admin/pengawas/delete/{id}', [AdminController::class, 'deletePengawas'])->name('api.delete.pengawas');

    Route::get('/api/admin/resepsionis/get', [AdminController::class, 'getResepsionis'])->name('api.get.resepsionis');
    Route::post('/api/admin/resepsionis/create', [AdminController::class, 'createResepsionis'])->name('api.create.resepsionis');
    Route::put('/api/admin/resepsionis/update/{id}', [AdminController::class, 'updateResepsionis'])->name('api.update.resepsionis');
    Route::delete('/api/admin/resepsionis/delete/{id}', [AdminController::class, 'deleteResepsionis'])->name('api.delete.resepsionis');

    Route::get('/api/admin/dokter/get', [AdminController::class, 'getDokter']);
    Route::post('/api/admin/dokter/create', [AdminController::class, 'createDokter']);
    Route::put('/api/admin/dokter/update/{id}', [AdminController::class, 'updateDokter']);
    Route::delete('/api/admin/dokter/delete/{id}', [AdminController::class, 'deleteDokter']);

    Route::get('/api/admin/pasien/get', [AdminController::class, 'getPasien'])->name('api.get.pasien');
    Route::post('/api/admin/pasien/create', [AdminController::class, 'createPasien'])->name('api.create.pasien');
    Route::put('/api/admin/pasien/update/{id}', [AdminController::class, 'updatePasien'])->name('api.update.pasien');
    Route::delete('/api/admin/pasien/delete/{id}', [AdminController::class, 'deletePasien'])->name('api.delete.pasien');
});

// Route::group(['middleware' => ['auth', 'level:dokter']], function () {
//     Route::get('/resume-medis', [DokterController::class, 'resumeMedis'])->name('resume-medis');
// });
Route::group(['middleware' => ['auth', 'level:admin,dokter']], function () {
    Route::get('/resume-medis/{id_pemeriksaan_awal}', [DokterController::class, 'resumeMedis'])->name('resume-medis');
    Route::post('/resume-medis/{id_pemeriksaan_awal}', [DokterController::class, 'simpanPemeriksaan'])->name('simpan-pemeriksaan');
    Route::get('/riwayat-konsultasi', [DokterController::class, 'riwayatKonsultasi'])->name('riwayat-konsultasi');
    Route::get('/rawat-jalan', [DokterController::class, 'rawatJalan'])->name('rawat-jalan');
    Route::post('/rawat-jalan/{id_pasien}', [DokterController::class, 'panggilPasien'])->name('panggil.pasien');
    Route::get('/tambah-obat-dokter/{id_pemeriksaan_akhir}', [DokterController::class, 'tambahObat'])->name('tambah-obat-dokter');
    Route::get('/get-obat/{kode_obat}', [DokterController::class, 'getObat']);
    Route::get('/cari-racikan', [DokterController::class, 'getObatRacikan']);
    Route::get('/api/obat-stocked', [DokterController::class, 'getObatRacikanStocked']);
    Route::get('/get-obat-racikan/{kode_obat}', [DokterController::class, 'getTambahObatRacikan']);
    Route::post('/simpan-racikan-ke-session', [DokterController::class, 'simpanKeSession']);
    Route::post('/simpan-resep', [DokterController::class, 'simpanNonRacikanSession'])->name('resep.simpan.session');
    Route::get('/view-pasien-dokter/{id_dokter}', [DokterController::class, 'viewPasienDokter'])->name('view-pasien-dokter');
    Route::get('/detail-data-pasien/{id_pemeriksaan_awal}', [DokterController::class, 'detailPasien'])->name('detail-data-pasien');
    Route::get('/riwayat-konsultasi-pasien/{id_pemeriksaan_awal}', [DokterController::class, 'riwayatKonsultasiPasien'])->name('riwayat-konsultasi-pasien');
    Route::get('/riwayat-konsultasi-pasien-selesai/{id_pemeriksaan_awal}', [DokterController::class, 'riwayatKonsulDone'])->name('riwayat-konsul-done');
    Route::get('/lihat-obat-pasien/{id_pemeriksaan_akhir}', [DokterController::class, 'lihatObatPasien'])->name('lihat-obat-pasien');
    Route::get('/api/lihat-obat-pasien/{id_pemeriksaan_akhir}', [DokterController::class, 'getObatByPemeriksaan']);
});

Route::group(['middleware' => ['auth', 'level:admin,pengawas,apoteker']], function () {

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

Route::group(['middleware' => ['auth', 'level:admin,resepsionis']], function () {
    Route::get('/cobajadwal/{id}', [PengawasMinumObatController::class, 'cobacoba'])->name('cobaminum');
    Route::get('/resepsionis', [ResepsionisController::class, 'inputDataPasien'])->name('resepsionis');
    Route::get('/api/resepsionis', [ApiResepsionisController::class, 'apiGetPasien']);
    Route::get('/resepsionis/detail-pasien/{id}', [ResepsionisController::class, 'showDetailView'])->name('pasien.detail.view');
    Route::get('/api/resepsionis-detail-pasien/{id}', [ApiResepsionisController::class, 'ApishowDetailView']);
    Route::get('/resepsionis-tambah-pasien/{no_rm?}', [ResepsionisController::class, 'storeDataPersonalForm'])->name('resepsionis-tambah-form');
    Route::get('/api/resepsionis-tambah-pasien/{no_rm?}', [ApiResepsionisController::class, 'apiGetPasienByNoRM']);
    Route::post('/resepsionis-tambah-pasien/{no_rm?}', [ResepsionisController::class, 'storeDataPersonal'])->name('resepsionis-tambah');
    Route::post('/api/resepsionis-tambah-pasien', [ApiResepsionisController::class, 'apiStorePasien']);
    // Menampilkan form tambah data kesehatan
    Route::get('/resepsionis-tambah-kesehatan/{id}', [ResepsionisController::class, 'tambahDataKesehatanPasien'])->name('resepsionis-tambah-kesehatan');
    Route::get('/api/resepsionis-tambah-kesehatan/{id}', [ApiResepsionisController::class, 'apiTambahDataKesehatanPasien']);

    // Menyimpan data ke pemeriksaan_awal
    Route::post('/resepsionis-tambah-kesehatan/{id}', [ResepsionisController::class, 'storeDataKesehatan'])->name('simpan-kesehatan');
    Route::post('/api/resepsionis-tambah-kesehatan/{id}', [ApiResepsionisController::class, 'storeDataKesehatanApi']);
});
