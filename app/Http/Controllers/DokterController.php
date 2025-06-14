<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use App\Http\Controllers\Controller;
use App\Models\IcdModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DokterController extends Controller
{
    public function resumeMedis($id_pemeriksaan_awal)
    {

        // $idPengguna = Auth::user()->id_pengguna;

        // $antreanPasien = DB::table('pemeriksaan_awal')
        //     ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
        //     ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
        //     ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
        //     ->select(
        //         'pemeriksaan_awal.*',
        //         'pasien.nama as nama_pasien',
        //         'pasien.no_rm',
        //         'pasien.nama',
        //         'pasien.jenis_kelamin',
        //         'pasien.tanggal_lahir',
        //         'pasien.no_telp',
        //         'pasien.alamat',
        //         'dokter.nama_dokter',
        //         'dokter.spesialis',
        //         'dokter.jenis_dokter',
        //         'dokter.kode_klinik',
        //     )
        //     ->where('dokter.id_pengguna', $idPengguna)
        //     ->whereDate('pemeriksaan_awal.tanggal_pemeriksaan', now())
        //     ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
        //     ->get();
        //     dd($antreanPasien);

        // $kunjungan = $antreanPasien->first();
        // $data_obat = DB::table('obat')->get();
        // dd($data_obat);
        // dd($kunjungan);
        $idPengguna = Auth::user()->id_pengguna;

        $kunjungan = DB::table('pemeriksaan_awal')
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
                'dokter.kode_klinik',
            )
            ->where('dokter.id_pengguna', $idPengguna)
            ->where('pemeriksaan_awal.id_pemeriksaan_awal', $id_pemeriksaan_awal)
            ->first();

        if (!$kunjungan) {
            abort(404, 'Data pemeriksaan tidak ditemukan');
        }

        $data_obat = DB::table('obat')->get();
        $data_icd = DB::table('icdtable')->get();
        // dd($data_icd);
        return view('dokter.resume-medis', compact('kunjungan', 'data_obat', 'data_icd'));
    }

    public function simpanPemeriksaan(Request $request, $id_pasien)
    {
        $idDokter = DB::table('dokter')
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->value('id_dokter');


        $kodeICDs = $request->input('icd_codes'); // array dari form

        DB::table('pemeriksaan_akhir')->insert([
            'id_pemeriksaan_awal' => $request->input('id_pemeriksaan_awal'),
            'id_dokter'           => $idDokter,
            'id_pasien'           => $id_pasien,
            'anamnesa'            => $request->input('anamnesa'),
            'diagnosis'           => $request->input('diagnosis'),
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
            'status_pemeriksaan' => 'Selesai',
            'medikamentosa'       => $request->input('medikamentosa'),
            'non_medikamentosa'   => $request->input('non_medikamentosa'),
            'kode_icd'            => json_encode($kodeICDs), // simpan sebagai json
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
        // $idPengguna = Auth::user()->id_pengguna;

        // $antreanPasien = DB::table('pemeriksaan_awal')
        //     ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
        //     ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
        //     ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
        //     ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pasien', '=', 'pemeriksaan_akhir.id_pasien')
        //     ->select(
        //         'pemeriksaan_awal.*',
        //         'pasien.nama as nama_pasien',
        //         'pasien.no_rm',
        //         'pasien.id_pasien',
        //         'dokter.nama_dokter',
        //         'dokter.spesialis',
        //         'dokter.jenis_dokter',
        //         'dokter.kode_klinik',
        //         'pemeriksaan_akhir.status_pemanggilan',
        //         'pemeriksaan_akhir.anamnesa',
        //         'pemeriksaan_akhir.medikamentosa',
        //     )
        //     ->where('dokter.id_pengguna', $idPengguna)
        //     ->whereDate('pemeriksaan_awal.tanggal_pemeriksaan', now())
        //     ->where(function ($query) {
        //         $query->whereNull('pemeriksaan_akhir.status_pemeriksaan')
        //             ->orWhereNotIn(DB::raw('LOWER(pemeriksaan_akhir.status_pemeriksaan)'), ['selesai']);
        //     })
        //     ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
        //     ->get();

        //     $latestPemeriksaan = DB::table('pemeriksaan_akhir as pa1')
        //         ->select('pa1.*')
        //         ->join(DB::raw('(
        //     SELECT MAX(id_pemeriksaan_akhir) as id_pemeriksaan_akhir
        //     FROM pemeriksaan_akhir
        //     GROUP BY id_pasien
        // ) as pa2'), 'pa1.id_pemeriksaan_akhir', '=', 'pa2.id_pemeriksaan_akhir');

        $idPengguna = Auth::user()->id_pengguna;
        $today = now()->toDateString();

        $antreanPasien = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->where('dokter.id_pengguna', $idPengguna)
            ->whereDate('pemeriksaan_awal.tanggal_pemeriksaan', $today)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('pemeriksaan_akhir')
                    ->whereRaw('pemeriksaan_awal.id_pemeriksaan_awal = pemeriksaan_akhir.id_pemeriksaan_awal')
                    ->whereRaw("LOWER(status_pemeriksaan) = 'selesai'");
            })
            ->select(
                'pemeriksaan_awal.*',
                'pasien.nama as nama_pasien',
                'pasien.no_rm',
                'pasien.id_pasien',
                'dokter.nama_dokter',
                'dokter.spesialis',
                'dokter.jenis_dokter',
                'dokter.kode_klinik',
            )
            ->orderBy('pemeriksaan_awal.created_at')
            ->get();
        // dd($antreanPasien);

        $idPengguna = Auth::user()->id_pengguna;

        $pasien_selesai_konsultasi = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
            ->select(
                'pemeriksaan_awal.*',
                'pasien.nama as nama_pasien',
                'pasien.no_rm',
                'pasien.id_pasien',
                'pasien.nama',
                'dokter.nama_dokter',
                'dokter.spesialis',
                'dokter.jenis_dokter',
                'dokter.kode_klinik',
                'pemeriksaan_akhir.status_pemeriksaan',
                'pemeriksaan_akhir.anamnesa',
                'pemeriksaan_akhir.medikamentosa'
            )
            ->where('dokter.id_pengguna', $idPengguna)
            ->where('pemeriksaan_akhir.status_pemeriksaan', 'selesai')
            // ->whereNull('pemeriksaan_akhir.id_pasien')
            ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
            ->get();

        return view('dokter.rawat-jalan', compact('antreanPasien', 'pasien_selesai_konsultasi'));
    }

    public function panggilPasien($id_pasien)
    {
        DB::table('pemeriksaan_awal')
            ->where('id_pasien', $id_pasien)
            ->update(['status_pemanggilan' => 'sudah dipanggil']);

        return redirect()->back()->with('success', 'Pasien berhasil dipanggil.');
    }

    public function tambahObat()
    {
        return \view('dokter.tambah-obat-dokter');
    }
    public function viewPasienDokter(Request $request, $id_dokter)
    {
        // $idPengguna = Auth::user()->id_pengguna;

        // $pasien_selesai_konsultasi = DB::table('pemeriksaan_awal')
        //     ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
        //     ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
        //     ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
        //     ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
        //     ->select(
        //         'pemeriksaan_awal.*',
        //         'pasien.*',
        //         'dokter.nama_dokter',
        //         'dokter.spesialis',
        //         'dokter.jenis_dokter',
        //         'dokter.kode_klinik',
        //         'pemeriksaan_akhir.status_pemeriksaan',
        //         'pemeriksaan_akhir.anamnesa',
        //         'pemeriksaan_akhir.medikamentosa'
        //     )
        //     ->where('dokter.id_pengguna', $idPengguna)
        //     ->where('pemeriksaan_akhir.status_pemeriksaan', 'selesai')
        //     // ->whereNull('pemeriksaan_akhir.id_pasien')
        //     ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
        //     ->paginate(10);
                // dd($pasien_selesai_konsultasi);

                // Ambil ID dokter dari pengguna yang sedang login
    $idDokter = DB::table('dokter')
        ->where('id_pengguna', Auth::user()->id_pengguna)
        ->value('id_dokter');

    // Pastikan dokter ditemukan
    if (!$idDokter) {
        abort(403, 'Dokter tidak ditemukan.');
    }
    // Ambil pasien dengan status pemeriksaan selesai
    $pasien_selesai_konsultasi = DB::table('pemeriksaan_awal')
        ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
        ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
        ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
        ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
        ->select(
            'pemeriksaan_awal.*',
            'pasien.*',
            'dokter.nama_dokter',
            'dokter.spesialis',
            'dokter.jenis_dokter',
            'dokter.kode_klinik',
            'pemeriksaan_akhir.status_pemeriksaan',
            'pemeriksaan_akhir.anamnesa',
            'pemeriksaan_akhir.medikamentosa'
        )
        ->where('pemeriksaan_awal.id_dokter', $idDokter)
        ->where('pemeriksaan_akhir.status_pemeriksaan', 'selesai')
        ->orderBy('pemeriksaan_awal.created_at', 'desc')
        ->paginate(10);

        return view('dokter.pasien-dokter', compact('pasien_selesai_konsultasi'));
    }
    public function detailPasien($id_pemeriksaan_awal)
    {
        $idPengguna = Auth::user()->id_pengguna;

        $kunjungan = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
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
                'dokter.kode_klinik',
                'pemeriksaan_akhir.*'
            )
            ->where('dokter.id_pengguna', $idPengguna)
            ->where('pemeriksaan_awal.id_pemeriksaan_awal', $id_pemeriksaan_awal)
            ->first();
        if (!$kunjungan) {
            abort(404, 'Data pemeriksaan tidak ditemukan');
        }
        // Decode kode_icd jika dalam bentuk JSON string
        $kode_icds = json_decode($kunjungan->kode_icd, true);

        // Ambil data deskripsi dari tabel icd_11
        $data_icd = IcdModel::whereIn('kode_icd', $kode_icds)->get();


        return view('dokter.detail-data-pasien', compact('kunjungan', 'data_icd'));
    }

    public function riwayatKonsultasiPasien($id_pemeriksaan_awal)
    {
        $idPengguna = Auth::user()->id_pengguna;

        $antreanPasien = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
            ->select(
                'pemeriksaan_awal.*',
                'pasien.nama as nama_pasien',
                'pasien.no_rm',
                'pasien.id_pasien',
                'pasien.jenis_kelamin',
                'pasien.tanggal_lahir',
                'pasien.no_telp',
                'pasien.alamat',
                'pasien.nama',
                'dokter.nama_dokter',
                'dokter.spesialis',
                'dokter.jenis_dokter',
                'dokter.kode_klinik',
                'pemeriksaan_akhir.status_pemeriksaan',
                'pemeriksaan_akhir.anamnesa',
                'pemeriksaan_akhir.diagnosis',
                'pemeriksaan_akhir.medikamentosa'
            )
            ->where('dokter.id_pengguna', $idPengguna)
            ->where('pemeriksaan_akhir.status_pemeriksaan', 'selesai')
            // ->whereNull('pemeriksaan_akhir.id_pasien')
            ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
            ->get();

        $kunjungan = $antreanPasien->first();
        // dd($kunjungan);
        $data_obat = DB::table('obat')->get();

        return view('dokter.riwayat-konsultasi-pasien', compact('kunjungan', 'antreanPasien'));
    }

    public function riwayatKonsulDone($id_pemeriksaan_awal)
    {

        $idPengguna = Auth::user()->id_pengguna;

        $antreanPasien = DB::table('pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
            ->select(
                'pemeriksaan_awal.*',
                'pasien.nama as nama_pasien',
                'pasien.no_rm',
                'pasien.id_pasien',
                'pasien.jenis_kelamin',
                'pasien.tanggal_lahir',
                'pasien.no_telp',
                'pasien.alamat',
                'pasien.nama',
                'dokter.nama_dokter',
                'dokter.spesialis',
                'dokter.jenis_dokter',
                'dokter.kode_klinik',
                'pemeriksaan_akhir.status_pemeriksaan',
                'pemeriksaan_akhir.anamnesa',
                'pemeriksaan_akhir.diagnosis',
                'pemeriksaan_akhir.medikamentosa'
            )
            ->where('dokter.id_pengguna', $idPengguna)
            ->where('pemeriksaan_akhir.status_pemeriksaan', 'selesai')
            // ->whereNull('pemeriksaan_akhir.id_pasien')
            ->orderBy('pemeriksaan_awal.created_at') // urutkan dari waktu daftar
            ->get();

        $kunjungan = $antreanPasien->first();
        // dd($kunjungan);
        $data_obat = DB::table('obat')->get();

        return view('dokter.riwayat-konsul-done', compact('kunjungan', 'antreanPasien'));
    }

    public function lihatObatPasien()
    {
        return \view('dokter.lihat-obat-pasien');
    }
}
