<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


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


Route::get('/forgot-password', function(){
    return view('forgot-password');
});
Route::get('/password-verification', function(){
    return view('new-pass-verification');
});
Route::get('/beranda', function(){
    return view('beranda');
});
