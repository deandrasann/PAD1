<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
use App\Models\ApotekerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
       return view('dashboard');
    }

    public function obat()
    {
        $data = User::latest()->paginate(2);
        return view('daftar_obat', compact('data'));
    }
    public function beranda()
    {
        $data = User::all();
        return view('beranda', compact('data'));
    }
    public function tambahResep(){
        $data_pasien = DB::table('pasien')->get();
        return view('pasien-resep', compact('data_pasien'));
    }
    public function pasienTerdaftar(){
        return view('pasien_terdaftar');
    }

    public function pasien() {
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('daftar-pasien', compact('data_pasien'));
    }
    public function resepTiapPasien(){
        $data = DB::table('users')->paginate(5);
        return view('resep-tiap-pasien', compact('data'));
    }
    public function detailDataObat(){
        return view('detail-data-obat');
    }
    public function riwayatResep(){
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('riwayat-resep-obat', compact('data_pasien'));
    }
    public function jumlahApoteker(){
        $data_apoteker = DB::table('users')->paginate(5);
        return view('admin.jumlah-apoteker', compact('data_apoteker'));
    }
}
