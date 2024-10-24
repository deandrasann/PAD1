<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index() {
        $data_pasien = PasienModel::latest()->paginate(2);
        return view('pasien_terdaftar', compact('data'));
    }
}
