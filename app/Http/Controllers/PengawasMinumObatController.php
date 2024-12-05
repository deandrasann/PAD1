<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengawasMinumObatController extends Controller
{
    public function pasienPMO(Request $request){
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')
                ->join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien') // Join dengan tabel resep
                ->whereNotNull('resep.id_pengawas') // Pastikan hanya pasien yang memiliki id_pengawas
                ->where(function($query) use ($search) {
                    $query->orWhere('pasien.no_rm', $search)
                        ->orWhere('pasien.nama', 'like', "%" . $search . "%")
                        ->orWhere('pasien.alamat', 'like', "%" . $search . "%")
                        ->orWhere('pasien.tanggal_lahir', $search);
                })
                ->groupBy('pasien.id_pasien') // Group berdasarkan id_pasien untuk memastikan hanya 1 pasien yang ditampilkan
                ->select('pasien.*') // Ambil semua kolom pasien
                ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien') // Join dengan tabel resep
                ->whereNotNull('resep.id_pengawas') // Pastikan hanya pasien yang memiliki id_pengawas
                ->groupBy('pasien.id_pasien') // Group berdasarkan id_pasien untuk memastikan hanya 1 pasien yang ditampilkan
                ->select('pasien.*') // Ambil semua kolom pasien
                ->paginate(5);
        }        
        return view('pmo.pmo-daftar-pasien', compact('data_pasien'));
    }

    public function cekpasienPMO(){
        return view('pmo.cek-pasien');
    }
}
