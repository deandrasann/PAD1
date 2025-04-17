<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DokterController extends Controller
{
    public function resumeMedis(){
        return view('dokter.resume-medis');
    }
    public function riwayatKonsultasi(){
        return view('dokter.riwayat-konsultasi');
    }
    public function rawatJalan(){
        return \view('dokter.rawat-jalan');
    }
    public function tambahObat(){
        return \view('dokter.tambah-obat-dokter');
    }
    public function viewPasienDokter(Request $request){
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')
            ->WhereNull('pasien.deleted_at')
            ->orWhere('no_rm', $search)
            ->orWhere('nama', 'like',"%" . $search . "%")
            ->orWhere('jenis_kelamin', 'like',"%" . $search . "%")
            ->orWhere('no_telp', 'like',"%" . $search . "%")
            ->orWhere('alamat', 'like',"%" . $search . "%")
            ->orWhere('tanggal_lahir', $search)
            ->orderBy('nama', 'asc')
            ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->WhereNull('pasien.deleted_at')
                ->orderBy('nama', 'asc')
                ->paginate(5);
        }
        return \view('dokter.pasien-dokter', compact('data_pasien'));

    }
    public function detailPasien(){
        return \view('dokter.detail-data-pasien');
    }
    public function riwayatKonsultasiPasien(){
        return \view('dokter.riwayat-konsultasi-pasien');
    }
    public function lihatObatPasien(){
        return \view('dokter.lihat-obat-pasien');
    }
}
