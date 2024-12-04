<?php

namespace App\Http\Controllers;

use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\ResepModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function resepTiapPasien(Request $request, $id){
        // $itemid = $request->input('kode_obat');
        // // dd($request->all());

        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('resep')->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
            ->where('resep.id_pasien', $id)
            ->where('resep.status_resep', 'setuju')
            ->where(function($query) use ($search) {  // Gunakan closure untuk kondisi pencarian
                $query->orWhere('indikasi', 'like', "%" . $search . "%")
                      ->orWhere('golongan_obat', 'like', "%" . $search . "%")
                      ->orWhere('nama_obat', 'like', "%" . $search . "%");
            })
            ->paginate(5);
        } else {
            $data = DB::table('resep')->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
            ->where('resep.id_pasien', $id)
            ->where('resep.status_resep', 'setuju')
            ->paginate(5);
        }
        
        // $data2 = DB::table('obat')->where('kode_obat', $itemid)->first();

        $kode_obat = $request->input('kode_obat');
        $obat = DB::table('obat')->where('kode_obat', $kode_obat)->first();

        // $data = DB::table('obat')->where('id_pasien', $id)->paginate(5);
        $data_dokter = DB::table('dokter')->get();
        $data_obat = DB::table('obat')->get();
        $data_pemeriksaan = DB::table('pemeriksaan')->get();
        // ApotekerModel::join('obat', 'apoteker.id_apoteker', '=', 'obat.id_apoteker')
        //         ->select('obat.*', 'apoteker.id_apoteker', 'apoteker.nama_apoteker')
        //         ->distinct()
        //         ->get();
        $resep_obat = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
                ->where('pasien.id_pasien', $id)
                ->select('pasien.*', 'resep.*')
                ->first();
        // dd($data_dokter);
        // $resep_obat1 = DB::table('resep')->get();
        return view('resep-tiap-pasien', compact('data', 'obat', 'resep_obat','data_dokter', 'data_obat', 'data_pemeriksaan'));
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

    public function store(Request $request) {
        $tambah_resep = ResepModel::insert([
            'no_antrian' => $request->input('no_antrian'),
            'id_pasien' => $request->input('id_pasien'),
            'id_dokter' => $request->input('id_dokter'),
            'kode_obat' => $request->input('kode_obat'),
            'tgl_resep' => NOW(),
            'total_harga' => $request->input('total_harga')
        ]);
        $idpasien = $request->id_pasien;
        return redirect()->route('resep-tiap-pasien', ['id' => $idpasien])->with('success', 'berhasil menambahkan data');
    }


    public function destroy($id) {
        $delete_resep = ResepModel::where('kode_obat', $id)->update(['status_resep' => 'deleted']);
        if ($delete_resep){
            return back();
        };
    }

    public function detailDataObat(){
        $data_detail_obat = DB::table('obat')->get();
        return view('detail-data-obat', compact('data_detail_obat'));
    }
}
