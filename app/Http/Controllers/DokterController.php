<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function resumeMedis(){
        return \view('dokter.resume-medis');
    }
    public function riwayatKonsultasi(){
        return \view('dokter.riwayat-konsultasi');
    }
}
