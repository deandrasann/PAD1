<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('tambah_resep');
    }
    public function pasienTerdaftar(){
        return view('pasien_terdaftar');
    }
}
