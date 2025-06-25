<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ResepsionisController extends Controller
{
    public function index(Request $request){
        // $data_pengawas =  DB::table('users')
        // ->join('pengawas', 'users.id_pengguna', '=', 'pengawas.id_pengguna')
        // ->select('users.*', 'pengawas.*')
        // ->paginate(5);
    // dd($data_pengawas);
    if ($request->has('search')) {
        $search = $request->input('search');
        $data_resepsionis = DB::table('users')
        ->join('resepsionis', 'users.id_pengguna', '=', 'resepsionis.id_pengguna')
        ->orWhere('users.username', 'like',"%" . $search . "%")
        ->orWhere('resepsionis.nama_resepsionis', 'like',"%" . $search . "%")
        ->orWhere('users.email', 'like',"%" . $search . "%")
        ->paginate(5);
    } else {
        $data_resepsionis = DB::table('users')
        ->join('resepsionis', 'users.id_pengguna', '=', 'resepsionis.id_pengguna')
        ->paginate(5);
    }

    return view('admin.jumlah-resepsionis', compact('data_resepsionis'));
    }

    public function tambahResepsionis() {
        return view('admin.tambah-resepsionis');
    }
    public function inputDataPasien(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');

            $data_pasien = DB::table('pasien')
                ->whereNull('deleted_at')
                ->where(function ($query) use ($search) {
                    $query->where('no_rm', $search)
                        ->orWhere('nama', 'like', '%' . $search . '%')
                        ->orWhere('jenis_kelamin', 'like', '%' . $search . '%')
                        ->orWhere('no_telp', 'like', '%' . $search . '%')
                        ->orWhere('alamat', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_lahir', 'like', '%' . $search . '%');
                })
                ->orderBy('nama', 'asc')
                ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->whereNull('deleted_at')
                ->orderBy('nama', 'asc')
                ->paginate(5);
        }
        // $data_pasien = DB::table('pasien')->paginate(5);
        return view('resepsionis.data-pasien', compact('data_pasien'));
    }
    public function storeDataPersonalForm($no_rm = null)
    {
        $pasien = null;

        if ($no_rm) {
            $pasien = DB::table('pasien')->where('no_rm', $no_rm)->first();
        }

        return view('resepsionis.tambah-data-personal', compact('pasien'));
    }
    public function storeDataPersonal(Request $request)
    {
        // Ambil no_rm terakhir
        $lastNoRM = DB::table('pasien')
            ->orderBy('id_pasien', 'desc')
            ->limit(1)
            ->value('no_rm');

        if ($lastNoRM && preg_match('/RM(\d+)/', $lastNoRM, $matches)) {
            $lastNumber = (int) $matches[1];
        } else {
            $lastNumber = 0;
        }

        $newNumber = $lastNumber + 1;
        $newNoRM = 'RM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT); // Contoh: RM0001

        // Simpan data ke tabel pasien menggunakan Query Builder
        $id_pasien = DB::table('pasien')->insertGetId([
            'no_rm' => $newNoRM,
            'id_pengguna' => 1,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'provinsi' => $request->nama_provinsi,
            'kabupaten' => $request->nama_kabupaten,
            'kecamatan' => $request->nama_kecamatan,
            'kelurahan' => $request->nama_kelurahan,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke form isi data kesehatan
        return redirect()->route('resepsionis-tambah-kesehatan', ['id' => $id_pasien]);
    }

    public function tambahDataKesehatanPasien($id)
    {
        $pasien = DB::table('pasien')->where('id_pasien', $id)->first();

        if (!$pasien) {
            return redirect()->route('resepsionis')->with('error', 'Pasien tidak ditemukan.');
        }

        $dokters = DB::table('dokter')->get();
        return view('resepsionis.tambah-data-kesehatan', compact('pasien', 'dokters'));
    }

    public function storeDataKesehatan($id, Request $request)
    {
        // $tanggalPemeriksaan = Carbon::now()->format('Y-m-d'); // atau sesuaikan dengan tanggal lain

        DB::table('pemeriksaan_awal')->insert([
            'id_pasien' => $id,
            'id_dokter' => $request->input('id_dokter'),
            'tanggal_pemeriksaan' => now(),
            'golongan_darah' => $request->input('golongan_darah'),
            'merokok' => $request->merokok,
            'berat_badan' => $request->input('berat_badan'),
            'tinggi_badan' => $request->tinggi_badan,
            'hamil_menyusui' => $request->hamil_menyusui,
            'keluhan_awal' => $request->keluhan_awal,
            'ket_alergi_obat' => $request->alergi_obat,
            'suhu_tubuh' => $request->input('suhu_tubuh'),
            'nadi' => $request->nadi,
            'sistole' => $request->sistole,
            'diastole' => $request->diastole,
            'pernapasan' => $request->pernapasan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('resepsionis')->with('success', 'Data kesehatan berhasil disimpan.');
    }

    public function showDetailView($id)
        {
            $pasien = PasienModel::where('id_pasien', $id)->first();

            if (!$pasien) {
                return redirect()->back()->with('error', 'Data pasien tidak ditemukan.');
            }

            return view('resepsionis.detail-personal', [
                'id_pasien' => $id,
                'no_rm' => $pasien->no_rm
            ]);
        }
}
