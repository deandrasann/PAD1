<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
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
        return view('tambah_resep', compact('data_pasien'));
    }
    public function pasienTerdaftar(){
        return view('pasien_terdaftar');
    }
}
