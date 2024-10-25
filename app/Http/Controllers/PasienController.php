<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index(Request $request) {
        $no_rm = $request->input('no_rm');
        $nama_pasien = $request->input('nama');
        $alamat = $request->input('alamat');
        $tgl_lahir = $request->input('tanggal_lahir');
        // dd($request->all());

        // $data_pasien = PasienModel::where('no_rm', $no_rm)
        //             ->orWhere('nama', 'LIKE', "%{$nama_pasien}%")
        //             ->get();
        if([$no_rm,$nama_pasien,$alamat,$tgl_lahir] !== null) {
        $data_pasien = DB::table('pasien')->where('no_rm', $no_rm,)
                        ->orWhere('nama', 'like',"%" . $nama_pasien . "%")
                        ->orWhere('alamat', 'like',"%" . $alamat . "%")
                        ->orWhere('tanggal_lahir', $tgl_lahir)
                        ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')->get();
        }
        return view('pasien_terdaftar', compact('data_pasien'));
    }
}
