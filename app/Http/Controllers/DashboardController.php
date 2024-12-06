<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\PasienModel;
use App\Models\User;
use App\Models\ApotekerModel;
use App\Models\ObatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
       return view('dashboard');
    }

    public function beranda()
    {
        $data = User::all();
        $data_pasien = DB::table('pasien')->count('id_pasien');
        $data_obat = DB::table('obat')->count('kode_obat');
        $data_apoteker = DB::table('apoteker')->count('id_apoteker');
        $data_pengawas = DB::table('pengawas')->count('id_pengawas');
        $data_pasien = DB::table('pasien')->count('id_pasien');
        $data_pasien_baru =DB::table('pasien')
        ->leftJoin('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')  // Join tabel pasien dengan resep berdasarkan id_pasien
        ->whereNull('resep.kode_obat')  // Memilih pasien yang tidak memiliki kode_obat (NULL)
        ->count(); 
    
        // dd($data_pasien);
        return view('beranda', compact('data', 'data_pasien', 'data_obat', 'data_apoteker', 'data_pengawas', 'data_pasien', 'data_pasien_baru'));
    }

    public function pasienTerdaftar(){
        return view('pasien_terdaftar');
    }

    
    
    public function riwayatResep(){
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('riwayat-resep-obat', compact('data_pasien'));
    }
    public function jumlahApoteker(){
        $data_apoteker = DB::table('users')->paginate(5);
        return view('admin.jumlah-apoteker', compact('data_apoteker'));
    }
        public function jumlahPengawas(){
        $data_pengawas = DB::table('users')->paginate(5);
        return view('admin.jumlah-pengawas', compact('data_pengawas'));
    }
    
    public function riwayatPasienPMO(){
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('pmo.riwayat-pasien', compact('data_pasien'));
    }
    
    public function riwayatMinumObat2(){
        return view('pmo.riwayat-minum-obat2');
    }
    public function riwayatDataResep(){
        return view('pmo.riwayat-resep');
    }
}

