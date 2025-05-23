<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepsionisController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')->orWhere('no_rm', $search)
                ->WhereNull('pasien.deleted_at')
                ->orWhere('nama', 'like', "%" . $search . "%")
                ->orWhere('alamat', 'like', "%" . $search . "%")
                ->orWhere('tanggal_lahir', $search)
                ->orderBy('nama', 'asc')
                ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->WhereNull('pasien.deleted_at')
                ->orderBy('nama', 'asc')
                ->paginate(5);
        }
        return view('resepsionis.cobadaftar',compact('data_pasien'));
    }
}
