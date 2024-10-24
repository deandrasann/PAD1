<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index() {
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('pasien_terdaftar', compact('data_pasien'));
    }
}
