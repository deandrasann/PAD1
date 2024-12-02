<?php

namespace App\Http\Controllers;

use App\Models\ObatModel;
use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function resepTiapPasien(Request $request, $id){
        // $itemid = $request->input('kode_obat');
        // // dd($request->all());

        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('obat')
            ->where('id_pasien', $id)
            ->where(function($query) use ($search) {  // Gunakan closure untuk kondisi pencarian
                $query->orWhere('indikasi', 'like', "%" . $search . "%")
                      ->orWhere('golongan_obat', 'like', "%" . $search . "%")
                      ->orWhere('nama_obat', 'like', "%" . $search . "%");
            })
            ->paginate(5);
        } else {
            $data = DB::table('obat')
            ->where('id_pasien', $id)
            ->paginate(5);
        }
        
        // $data2 = DB::table('obat')->where('kode_obat', $itemid)->first();

        $kode_obat = $request->input('kode_obat');
        $obat = DB::table('obat')->where('kode_obat', $kode_obat)->first();

        // $data = DB::table('obat')->where('id_pasien', $id)->paginate(5);
        $apoteker_obat = DB::table('apoteker')->get();
        // ApotekerModel::join('obat', 'apoteker.id_apoteker', '=', 'obat.id_apoteker')
        //         ->select('obat.*', 'apoteker.id_apoteker', 'apoteker.nama_apoteker')
        //         ->distinct()
        //         ->get();
        $resep_obat = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
                ->where('pasien.id_pasien', $id)
                ->select('pasien.*', 'resep.*')
                ->first();
        // dd($apoteker_obat);
        // $resep_obat1 = DB::table('resep')->get();
        return view('resep-tiap-pasien', compact('data', 'obat', 'resep_obat', 'apoteker_obat'));
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
        $tambah_obat = ObatModel::insert([
            'id_pasien' => $request->input('id_pasien'),
            'id_apoteker' => $request->input('id_apoteker'),
            'nama_obat' => $request->input('nama_obat'),
            'bentuk_obat' => $request->input('bentuk_obat'),
            'kekuatan_sediaan' => $request->input('kekuatan_sediaan'),
            'efek_samping' => $request->input('efek_samping'),
            'kontraindikasi' => $request->input('kontraindikasi'),
            'interaksi_obat' => $request->input('interaksi_obat'),
            'petunjuk_penyimpanan' => $request->input('petunjuk_penyimpanan'),
            'pola_makan' => $request->input('pola_makan'),
            'informasi_tambahan' => $request->input('informasi_tambahan'),
            'indikasi' => $request->input('indikasi'),
            'golongan_obat' => $request->input('golongan_obat'),

        ]);
        $idpasien = $request->id_pasien;
        return redirect()->route('resep-tiap-pasien', ['id' => $idpasien])->with('success', 'berhasil menambahkan data');
    }

    public function update(Request $request, $id) {
        $data = [
            'nama_obat' => $request->input('nama_obat'),
            'bentuk_obat' => $request->input('bentuk_obat'),
            'kekuatan_sediaan' => $request->input('kekuatan_sediaan'),
            'efek_samping' => $request->input('efek_samping'),
            'kontraindikasi' => $request->input('kontraindikasi'),
            'indikasi' => $request->input('indikasi'),
            'interaksi_obat' => $request->input('interaksi_obat'),
            'petunjuk_penyimpanan' => $request->input('petunjuk_penyimpanan'),
            'golongan_obat' => $request->input('golongan_obat'),
            'pola_makan' => $request->input('pola_makan'),
            'informasi_tambahan' => $request->input('informasi_tambahan'),
        ];
        $data_obat = ObatModel::find($id);
        $idpasien = $request->id_pasien;
        $upd = ObatModel::where('kode_obat', '=', $data_obat->kode_obat)->update($data);
        // dd($upd);
        return redirect()->route('resep-tiap-pasien', ['id' => $idpasien])->with('success', 'berhasil mengubah data');
    }

    public function destroy($id) {
        $delete_obat = ObatModel::where('kode_obat', $id)->delete();
        if ($delete_obat){
            return back();
        };
    }
}
