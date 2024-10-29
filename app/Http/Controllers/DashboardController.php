<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\PasienModel;
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
    public function tambahResep(Request $request){
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')->orWhere('no_rm', $search)
            ->orWhere('nama', 'like',"%" . $search . "%")
            ->orWhere('alamat', 'like',"%" . $search . "%")
            ->orWhere('tanggal_lahir', $search)
            ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->paginate(5);
        }
        return view('pasien-resep', compact('data_pasien'));
    }
    public function detail($id) {

    }
    public function pasienTerdaftar(){
        return view('pasien_terdaftar');
    }

    public function pasien(Request $request) {
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('daftar-pasien', compact('data_pasien'));
    }
    public function resepTiapPasien(Request $request, $id){
        // $itemid = $request->input('kode_obat');
        // // dd($request->all());

        // $data2 = DB::table('obat')->where('kode_obat', $itemid)->first(); 

        $kode_obat = $request->input('kode_obat');
        $obat = DB::table('obat')->where('kode_obat', $kode_obat)->first();

        $data = DB::table('obat')->where('id_pasien', $id)->paginate(5); 
        $resep_obat = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
                ->where('pasien.id_pasien', $id)
                ->select('pasien.*', 'resep.*')
                ->first();
        // dd($resep_obat);
        // $resep_obat1 = DB::table('resep')->get();
        return view('resep-tiap-pasien', compact('data', 'obat', 'resep_obat'));
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
