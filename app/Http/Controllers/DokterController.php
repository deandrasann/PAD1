<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DokterController extends Controller
{
    public function resumeMedis($id_pasien)
    {

        $idPengguna = Auth::user()->id_pengguna;

        $antreanPasien = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->select(
                'pemeriksaan_awal.*',
                'pasien.nama as nama_pasien',
                'pasien.no_rm',
                'pasien.nama',
                'pasien.jenis_kelamin',
                'pasien.tanggal_lahir',
                'pasien.no_telp',
                'pasien.alamat',
                'dokter.nama_dokter',
                'dokter.spesialis',
                'dokter.jenis_dokter',
                'dokter.kode_klinik'
            )

            ->where('dokter.id_pengguna', $idPengguna)
            ->whereDate('pemeriksaan_awal.tanggal_pemeriksaan', now())
            ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
            ->get();

        $kunjungan = $antreanPasien->first();
        $data_obat = DB::table('obat')->get();
        // dd($data_obat);
        // dd($kunjungan);
        return view('dokter.resume-medis', compact('kunjungan', 'data_obat'));
    }

    public function simpanPemeriksaan(Request $request, $id_pasien)
    {
        $idDokter = DB::table('dokter')
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->value('id_dokter');

        DB::table('pemeriksaan_akhir')->insert([
            'id_dokter'           => $idDokter,
            'id_pasien'           => $id_pasien,
            'anamnesa'            => $request->input('anamnesa'),
            'frekuensi'           => $request->input('frekuensi'),
            'golongan_darah'      => $request->input('golongan_darah'),
            'berat_badan'         => $request->input('berat_badan'),
            'tinggi_badan'        => $request->input('tinggi_badan'),
            'merokok'             => $request->input('merokok'),
            'hamil_menyusui'      => $request->input('hamil_menyusui'),
            'keluhan_awal'        => $request->input('keluhan_awal'),
            'suhu_tubuh'          => $request->input('suhu_tubuh'),
            'nadi'                => $request->input('nadi'),
            'sistole'             => $request->input('sistole'),
            'diastole'            => $request->input('diastole'),
            'pernapasan'          => $request->input('pernapasan'),
            'status_pemeriksaaan' => 'Selesai',
            'medikamentosa'       => $request->input('medikamentosa'),
            'non_medikamentosa'   => $request->input('non_medikamentosa'),
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        return redirect()->route('rawat-jalan')->with('success', 'Pemeriksaan berhasil disimpan');
    }

    public function riwayatKonsultasi()
    {
        return view('dokter.riwayat-konsultasi');
    }
    public function rawatJalan()
    {
        $idPengguna = Auth::user()->id_pengguna;

        $antreanPasien = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->select(
                'pemeriksaan_awal.*',
                'pasien.nama as nama_pasien',
                'pasien.no_rm',
                'pasien.id_pasien',
                'dokter.nama_dokter',
                'dokter.spesialis',
                'dokter.jenis_dokter',
                'dokter.kode_klinik'
            )
            ->where('dokter.id_pengguna', $idPengguna)
            ->whereDate('pemeriksaan_awal.tanggal_pemeriksaan', now())
            ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
            ->get();


        return \view('dokter.rawat-jalan', compact('antreanPasien'));
    }

    public function tambahObat()
    {
        return \view('dokter.tambah-obat-dokter');
    }
    public function viewPasienDokter(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')
                ->WhereNull('pasien.deleted_at')
                ->orWhere('no_rm', $search)
                ->orWhere('nama', 'like', "%" . $search . "%")
                ->orWhere('jenis_kelamin', 'like', "%" . $search . "%")
                ->orWhere('no_telp', 'like', "%" . $search . "%")
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
        return \view('dokter.pasien-dokter', compact('data_pasien'));
    }
    public function detailPasien()
    {
        return \view('dokter.detail-data-pasien');
    }
    public function riwayatKonsultasiPasien()
    {
        return \view('dokter.riwayat-konsultasi-pasien');
    }
    public function lihatObatPasien()
    {
        return \view('dokter.lihat-obat-pasien');
    }
    public function coba()
    {
        return view('cobadropdown');
    }
}
