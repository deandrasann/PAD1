<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        if ($data == null) {
            return redirect('login');
        }
        $cekuser = Auth::user()->id_role;
        // dd($cekuser);
        // dd($data);
        return view('coba', compact('cekuser'));
    }
}
