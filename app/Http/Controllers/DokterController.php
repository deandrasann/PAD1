<?php

namespace App\Http\Controllers;

use App\Models\obatRacikanModel;
use App\Models\PasienModel;
use App\Http\Controllers\Controller;
use App\Models\IcdModel;
use App\Models\ObatModel;
use App\Models\obatNonRacikanModel;
use App\Models\PemeriksaanAwalModel;
use App\Models\ResepModel;
use App\Models\ResepObatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        // $data_dokter =  DB::table('users')
        // ->join('dokter', 'users.id_pengguna', '=', 'dokter.id_pengguna')
        // ->select('users.*', 'dokter.*')
        // ->paginate(5);
        // dd($data_dokter);
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_dokter = DB::table('users')
                ->join('dokter', 'users.id_pengguna', '=', 'dokter.id_pengguna')
                ->orWhere('users.username', 'like', "%" . $search . "%")
                ->orWhere('dokter.nama_dokter', 'like', "%" . $search . "%")
                ->orWhere('users.email', 'like', "%" . $search . "%")
                ->paginate(5);
        } else {
            $data_dokter = DB::table('users')
                ->join('dokter', 'users.id_pengguna', '=', 'dokter.id_pengguna')
                ->paginate(5);
        }

        return view('admin.jumlah-dokter', compact('data_dokter'));
    }

    public function tambahDokter()
    {
        return view('admin.tambah-dokter');
    }
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
        // dd(session('data_resep' . $id_pemeriksaan_awal));
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

        $pemeriksaanAwal = PemeriksaanAwalModel::where('id_pemeriksaan_awal', $id_pasien)->first();

        $idPemeriksaanAkhir = DB::table('pemeriksaan_akhir')->insertGetId([
            'id_pemeriksaan_awal' => $request->input('id_pemeriksaan_awal'),
            'id_dokter'           => $idDokter,
            'id_pasien'           => $pemeriksaanAwal->id_pasien,
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

        return redirect()->route('tambah-obat-dokter', ['id_pemeriksaan_akhir' => $idPemeriksaanAkhir])->with('success', 'Pemeriksaan berhasil disimpan');
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

    public function tambahObat($id_pemeriksaan_akhir)
    {
        $idPengguna = Auth::user()->id_pengguna;

        $kunjungan = DB::table('pemeriksaan_akhir')
            ->join('pemeriksaan_awal', 'pemeriksaan_akhir.id_pemeriksaan_awal', '=', 'pemeriksaan_awal.id_pemeriksaan_awal')
            ->join('pasien', 'pemeriksaan_awal.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_awal.id_dokter', '=', 'dokter.id_dokter')
            ->join('users', 'dokter.id_pengguna', '=', 'users.id_pengguna')
            ->select(
                'pemeriksaan_akhir.*',
                'pemeriksaan_awal.id_pemeriksaan_awal',
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
            ->where('pemeriksaan_akhir.id_pemeriksaan_akhir', $id_pemeriksaan_akhir)
            ->first();

        if (!$kunjungan) {
            abort(404, 'Data pemeriksaan tidak ditemukan');
        }

        $data_obat = DB::table('obat')->get();
        $data_icd = DB::table('icdtable')->get();

        return view('dokter.tambah-obat-dokter', compact('kunjungan', 'data_obat'));
    }

    public function getObat($kode_obat)
    {
        $obat = DB::table('obat')
            ->where('kode_obat', $kode_obat)
            ->first();

        if (!$obat) {
            return response()->json(['error' => 'Obat tidak ditemukan'], 404);
        }

        return response()->json([
            'kekuatan_sediaan' => $obat->kekuatan_sediaan,
            'harga_satuan' => $obat->harga_satuan,
            'kemasan_obat' => $obat->kemasan_obat,
        ]);
    }

    public function simpanNonRacikanSession(Request $request)
    {
        function getValidIntFromJumlah($jumlah) {
            if (preg_match('/^\d+/', $jumlah, $matches)) {
                $nilai = (int)$matches[0];

                return $nilai;
            } else {
                return null;  // Atau bisa mengganti ini dengan exception atau pesan error sesuai kebutuhan
            }
        }
        
        $validator = Validator::make($request->all(), [
            'id_pemeriksaan_akhir' => 'required|exists:pemeriksaan_akhir,id_pemeriksaan_akhir',
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'id_pasien' => 'required|exists:pasien,id_pasien',

            'non_racikan' => 'nullable|array',
            'non_racikan.*.nama_obat' => 'required|string',
            'non_racikan.*.jml_obat' => 'required|integer|min:1',
            'non_racikan.*.bentuk_obat' => 'required|string',
            'non_racikan.*.harga_satuan' => 'required|numeric|min:0',
            'non_racikan.*.harga_total' => 'required|numeric|min:0',
            'non_racikan.*.signatura' => 'required|string',
            'non_racikan.*.signatura_label' => 'nullable|string',

            'racikan' => 'nullable|array',
            'racikan.*.obat' => 'nullable|array',
            'racikan.*.nama_racikan' => 'required|string',
            'racikan.*.bentuk_obat' => 'required|string',
            'racikan.*.kemasan_obat' => 'required|string',
            'racikan.*.instruksi_pemakaian' => 'nullable|string',
            'racikan.*.instruksi_racikan' => 'nullable|string',
            'racikan.*.jumlah_kemasan' => 'required|integer|min:1',
            'racikan.*.takaran_obat' => 'required|string',
            'racikan.*.dosis' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        DB::beginTransaction();
        try {
            $resep = ResepModel::create([
                'id_pemeriksaan_akhir' => $data['id_pemeriksaan_akhir'],
                'id_dokter' => $data['id_dokter'],
                'id_pasien' => $data['id_pasien'],
                'tgl_resep' => now(),
            ]);
            // --- Simpan Non Racikan ---
            if (!empty($data['non_racikan'])) {
                foreach ($data['non_racikan'] as $obat) {
                    $obatData = ObatModel::where('kode_obat', $obat['nama_obat'])->first();
                    if(!$obatData) {
                        return response()->json(['success' => false, 'message' => 'Obat tidak ditemukan'], 404);
                    }
                    $validJumlah = getValidIntFromJumlah($obat['jml_obat']);
                    $validSignatura = getValidIntFromJumlah($obat['signatura']);
                    if($validSignatura === null) {
                        return response()->json(['success' => false, 'message' => 'Signatura tidak valid', 'errors' =>[
                            'signatura' => ['Signatura harus berisi angka atau format yang valid.']
                        ]], 422);
                    }
                    if($validJumlah === null) {
                        return response()->json(['success' => false, 'message' => 'Jumlah obat tidak valid', 'errors' => [
                            'jml_obat' => ['Jumlah obat harus berisi angka atau format yang valid.']
                        ]], 422);
                    }
                    if($obatData->kekuatan_sediaan < $validJumlah) {
                        return response()->json(['success' => false, 'message' => 'Jumlah obat melebihi stok yang tersedia', 'errors' => [
                            'jml_obat' => ['Jumlah obat melebihi stok yang tersedia.']
                        ]], 422);
                    }
                    $obatNonRacikan = obatNonRacikanModel::create([
                        'id_pemeriksaan_akhir' => $data['id_pemeriksaan_akhir'],
                        'id_dokter' => $data['id_dokter'],
                        'id_pasien' => $data['id_pasien'],
                        'kode_obat' => $obat['nama_obat'],
                        'jml_obat' => $obat['jml_obat'],
                        'bentuk_obat' => $obat['bentuk_obat'],
                        'harga_satuan' => $obat['harga_satuan'],
                        'harga_total' => $obat['harga_total'],
                        'signatura' => $obat['signatura'],
                        'signatura_label' => $obat['signatura_label'] ?? null,
                    ]);
                    $obatData->kekuatan_sediaan -= $validJumlah;
                    $obatData->save();
                    
                    $resepObat = ResepObatModel::create([
                        'no_resep' => $resep->no_resep,
                        'id_obat_non_racikan' => $obatNonRacikan->id_obat_non_racikan,
                        'jenis_obat' => 'non_racikan',
                    ]);
                }
            }

            // --- Simpan Racikan (tanpa detail obat) ---
            if (!empty($data['racikan'])) {
                foreach ($data['racikan'] as $racik) {
                    if(empty($racik['obat']) || !is_array($racik['obat'])) {
                        return response()->json(['success' => false, 'message' => 'Racikan harus memiliki daftar obat yang valid', 'errors'  => [
                            'obat' => ['Racikan harus memiliki daftar obat yang valid.']
                        ]], 422);
                    }
                    if($racik["dosis"] == "x"){
                        return response()->json(['success' => false, 'message' => 'Dosis harus diisi.', 'errors'  => [
                            'dosis' => ['Dosis harus diisi.']
                        ]], 422);
                    }
                    foreach($racik['obat'] as $obat) {
                        $obatData = ObatModel::where('kode_obat', $obat['kode_obat'])->first();
                        if(!$obatData) {
                            return response()->json(['success' => false, 'message' => 'Obat tidak ditemukan', 'errors' => [
                            'kode_obat' => ['Obat dengan kode tersebut tidak ditemukan.']
                            ]], 404);
                        }
                        $validJumlah = getValidIntFromJumlah($obat['jumlah']);
                        if($validJumlah === null) {
                            return response()->json(['success' => false, 'message' => 'Jumlah obat tidak valid', 'errors' => [
                                'jumlah' => ['Jumlah obat harus berisi angka atau format yang valid.']
                            ]], 422);
                        }
                        if($obatData->kekuatan_sediaan < $validJumlah) {
                            return response()->json(['success' => false, 'message' => 'Jumlah obat melebihi stok yang tersedia', 'errors' => [
                                'jumlah' => ['Jumlah obat melebihi stok yang tersedia.']
                            ]], 422);
                        }
                        $obatData->kekuatan_sediaan -= $validJumlah;
                        $obatData->save();
                    }
                    $obatRacikan = obatRacikanModel::create([
                        'id_pemeriksaan_akhir' => $data['id_pemeriksaan_akhir'],
                        'id_dokter' => $data['id_dokter'],
                        'id_pasien' => $data['id_pasien'],
                        'nama_racikan' => $racik['nama_racikan'],
                        'bentuk_obat' => $racik['bentuk_obat'],
                        'kemasan_obat' => $racik['kemasan_obat'],
                        'instruksi_pemakaian' => $racik['instruksi_pemakaian'] ?? null,
                        'instruksi_racikan' => $racik['instruksi_racikan'] ?? null,
                        'jumlah_kemasan' => $racik['jumlah_kemasan'],
                        'takaran_obat' => $racik['takaran_obat'],
                        'dosis' => $racik['dosis'],
                    ]);
                    $resepObat = ResepObatModel::create([
                        'no_resep' => $resep->no_resep,
                        'id_obat_racikan' => $obatRacikan->id_obat_racikan,
                        'jenis_obat' => 'racikan',
                    ]);
                    $resepObat = ResepObatModel::create([
                        'no_resep' => $resep->no_resep,
                        'id_obat_racikan' => $obatRacikan->id_obat_racikan,
                        'jenis_obat' => 'racikan',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data resep berhasil disimpan!',
                'redirect' => route('rawat-jalan'), // sesuaikan dengan kebutuhan
                'data' => $data
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan resep: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan resep.',
                'error' => $e->getMessage(),
                'data' => $data
            ], 500);
        }
    }

    public function getObatRacikan(Request $request)
    {
        $query = $request->query('query');

        $racikan = DB::table('obat_racikan')
            ->where('nama_racikan', 'like', '%' . $query . '%')
            ->select('id_obat_racikan', 'nama_racikan')
            ->limit(10)
            ->get();

        return response()->json($racikan);
    }

    public function getTambahObatRacikan($kode_obat)
    {
        $obat = DB::table('obat')
            ->where('kode_obat', $kode_obat)
            ->where('status_ketersediaan_obat', 'Stocked')
            ->first();

        if (!$obat) {
            return response()->json(['error' => 'Obat tidak ditemukan atau sedang tidak tersedia'], 404);
        }
        return response()->json($obat);
    }

    public function getObatRacikanStocked(Request $request)
    {
        $search = $request->get('term');
        $obat = DB::table('obat')
            ->where('status_ketersediaan_obat', 'Stocked')
            ->when($search, function ($query, $search) {
                return $query->where('nama_obat', 'like', "%{$search}%");
            })
            ->select('kode_obat', 'nama_obat')
            ->get();

        return response()->json($obat);
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

    /**
     * Mengambil data obat non-racikan dan racikan untuk pemeriksaan tertentu
     * menggunakan Query Builder.
     *
     * @param  int  $id_pemeriksaan_akhir
     * @return \Illuminate\Http\JsonResponse
     */
    public function lihatObatPasien($id_pemeriksaan_akhir)
    {
        $id_pengguna = Auth::id();

        // Ambil id_dokter berdasarkan id_pengguna dari user yang login
        $dokter = DB::table('dokter')->where('id_pengguna', $id_pengguna)->first();

        // Jika dokter tidak ditemukan, blok akses
        if (!$dokter) {
            abort(403, 'Dokter tidak ditemukan atau Anda tidak memiliki izin.');
        }

        // Cek apakah pemeriksaan_akhir milik dokter ini
        $pemeriksaanExists = DB::table('pemeriksaan_akhir')
            ->where('id_pemeriksaan_akhir', $id_pemeriksaan_akhir)
            ->where('id_dokter', $dokter->id_dokter)
            ->first();

        if (!$pemeriksaanExists) {
            abort(403, 'Data tidak ditemukan atau bukan milik Anda.');
        }

        $pemeriksaan = DB::table('pemeriksaan_akhir')->where('id_pemeriksaan_akhir', $id_pemeriksaan_akhir)->first();
        if (!$pemeriksaan) abort(404);
        $kunjungan = DB::table('pasien')->where('id_pasien', $pemeriksaan->id_pasien)->first();
        // dd($pasien);
        return view('dokter.lihat-obat-pasien', compact('pemeriksaanExists', 'kunjungan'));
    }

    public function getObatByPemeriksaan($id_pemeriksaan_akhir)
    {
         try {
            // 1. Cari resep berdasarkan ID pemeriksaan
            $resep = DB::table('resep')->where('id_pemeriksaan_akhir', $id_pemeriksaan_akhir)->first();

            if (!$resep) {
                // Jika tidak ada resep, kembalikan array kosong. Ini bukan error.
                return response()->json([
                    'success' => true,
                    'data' => ['obat_non_racikan' => [], 'obat_racikan' => []],
                    'message' => 'Tidak ada resep untuk pemeriksaan ini.'
                ]);
            }

            // 2. Ambil semua ID item dari tabel resep_obat
            $items_resep = DB::table('resep_obat')
                ->where('no_resep', $resep->no_resep)
                ->get();

            $non_racikan_ids = $items_resep->where('jenis_obat', 'non_racikan')->pluck('id_obat_non_racikan')->filter();
            $racikan_ids = $items_resep->where('jenis_obat', 'racikan')->pluck('id_obat_racikan')->filter();

            $obat_non_racikan_list = [];
            $obat_racikan_list = [];

            // 3. Ambil detail semua obat non-racikan dalam resep ini
            if ($non_racikan_ids->isNotEmpty()) {
                $obat_non_racikan_list = DB::table('obat_non_racikan')
                    ->join('obat', 'obat_non_racikan.kode_obat', '=', 'obat.kode_obat')
                    ->whereIn('id_obat_non_racikan', $non_racikan_ids)
                    ->select('obat_non_racikan.*', 'obat.nama_obat', 'obat.harga_satuan') // Ambil juga harga satuan dari tabel obat
                    ->get()
                    ->toArray(); // Ubah ke array agar mudah dimanipulasi
            }

            // 4. Ambil detail semua "wadah" racikan dan sisipkan komponennya
            if ($racikan_ids->isNotEmpty()) {
                $obat_racikan_list = DB::table('obat_racikan')
                    ->whereIn('id_obat_racikan', $racikan_ids)
                    ->get();
                
                // Untuk setiap racikan, komponennya adalah SEMUA obat non-racikan dari resep yang sama
                foreach ($obat_racikan_list as $racikan) {
                    // Buat salinan data komponen untuk setiap racikan
                    $komponen_untuk_racikan = [];
                    foreach ($obat_non_racikan_list as $non_racikan_item) {
                        // Di sini kita sesuaikan field agar cocok dengan frontend
                        $komponen_untuk_racikan[] = [
                            'nama_obat' => $non_racikan_item->nama_obat,
                            'bentuk_obat' => $non_racikan_item->bentuk_obat,
                            'harga_satuan' => $non_racikan_item->harga_satuan,
                            // Asumsi jumlah diperlukan = jumlah yang diresepkan
                            'jumlah_diperlukan' => $non_racikan_item->jml_obat 
                        ];
                    }
                    $racikan->komponen = $komponen_untuk_racikan;
                }
            }

            $data = [
                'obat_non_racikan' => $obat_non_racikan_list,
                'obat_racikan' => $obat_racikan_list,
            ];

            return response()->json(['success' => true, 'data' => $data, 'message' => 'Data obat berhasil diambil.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
