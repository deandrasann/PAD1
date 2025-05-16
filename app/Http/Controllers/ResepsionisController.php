<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResepsionisController extends Controller
{
    public function inputDataPasien(Request $request) {
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
        // $data_pasien = DB::table('pasien')->paginate(5);
        return view('resepsionis.data-pasien', compact('data_pasien'));
    }
    public function tambahDataPasien(){
        return view('resepsionis.tambah-data-personal');
    }
}
