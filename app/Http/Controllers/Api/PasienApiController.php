<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ObatModel;
use App\Models\obatNonRacikanModel;
use App\Models\obatRacikanModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanAkhirModel;
use App\Models\PemeriksaanAwalModel;
use App\Models\ResepModel;
use App\Models\RiwayatMinumObatModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PasienApiController extends Controller
{
    public function createPasien(Request $request)
    {
        // Validasi input data pasien sesuai dengan PasienModel yang baru
        $request->validate([
            'username' => 'required|max:100|unique:users,username',
            'nama' => 'required|max:100',
            'email' => 'required|email|unique:users,email', // Email utama untuk akun pengguna
            'password' => 'required|min:3',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|max:255',
            'provinsi' => 'required|max:100',
            'kabupaten' => 'required|max:100',
            'kecamatan' => 'required|max:100',
            'kelurahan' => 'required|max:100',
            'no_telp' => 'required|max:15|unique:pasien,no_telp', // Nomor Telepon, required dan unik
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:3096' // Foto bersifat opsional
        ]);

        do {
            $lastNoRM = DB::table('pasien')
                ->orderBy('id_pasien', 'desc')
                ->value('no_rm');

            if ($lastNoRM && preg_match('/RM(\d+)/', $lastNoRM, $matches)) {
                $lastNumber = (int) $matches[1];
            } else {
                $lastNumber = 0;
            }

            $newNumber = $lastNumber + 1;
            $newNoRM = 'RM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            $exists = DB::table('pasien')->where('no_rm', $newNoRM)->exists();
        } while ($exists);

        $path = 'avatars/noimage.png'; // Path default jika tidak ada foto diunggah
        if ($request->hasFile('foto')) {
            // Mengambil nama asli file, nama file tanpa ekstensi, dan ekstensi file
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();

            // Membuat nama file baru yang unik untuk disimpan
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            // Menyimpan file ke direktori 'avatars'
            $path = $request->file('foto')->storeAs('avatars', $filenameSimpan);
        }

        DB::beginTransaction(); // Memulai transaksi database untuk memastikan atomicity

        try {
            // Data untuk tabel 'users'
            $userData = [
                'id_role' => 'R05', // Mengasumsikan 'R04' adalah ID role untuk pasien
                'nama_role' => 'pasien',
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // Mengenkripsi password
            ];
            $user = User::create($userData); // Menyimpan data ke tabel 'users'

            // Data untuk tabel 'pasien', menggunakan id_pengguna yang baru dibuat dari tabel 'users'
            $pasienData = [
                'id_pengguna' => $user->id_pengguna, // Menghubungkan dengan tabel 'users'
                'no_rm' => $newNoRM,
                'nama' => $request->input('nama'), // Menggunakan nama sesuai model
                'alamat' => $request->input('alamat'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'provinsi' => $request->input('provinsi'),
                'kabupaten' => $request->input('kabupaten'),
                'kecamatan' => $request->input('kecamatan'),
                'kelurahan' => $request->input('kelurahan'),
                'no_telp' => $request->input('no_telp'),
                'email' => $user->email, // Menggunakan email dari tabel users
                'foto' => $path
            ];
            PasienModel::create($pasienData); // Menyimpan data ke tabel 'pasien'

            DB::commit(); // Melakukan commit jika semua operasi berhasil
            return response()->json([
                'status' => 'success',
                'message' => 'Data pasien berhasil ditambahkan.',
                'data' => [
                    'user' => $user,
                    'pasien' => $pasienData
                ]
            ], 201); // Kode status HTTP 201 untuk 'Created'
        } catch (\Exception $e) {
            DB::rollback(); // Melakukan rollback jika terjadi kesalahan
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data pasien',
                'error' => $e->getMessage()
            ], 500); // Kode status HTTP 500 untuk 'Internal Server Error'
        }
    }

    /**
     * Mengambil data pasien.
     * Method ini dapat mengambil semua data pasien atau melakukan pencarian berdasarkan
     * username, nama pasien, email, nomor rekam medis (no_rm), atau nomor telepon (no_telp).
     * Hasilnya dipaginasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPasien(Request $request)
    {
        $data_pasien = null;
        // Mengecek apakah ada parameter 'search' pada request untuk melakukan pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('users')
                ->join('pasien', 'users.id_pengguna', '=', 'pasien.id_pengguna')
                ->orWhere('users.username', 'like', "%" . $search . "%")
                ->orWhere('pasien.nama', 'like', "%" . $search . "%")
                ->orWhere('users.email', 'like', "%" . $search . "%")
                ->orWhere('pasien.no_rm', 'like', "%" . $search . "%")
                ->orWhere('pasien.no_telp', 'like', "%" . $search . "%")
                ->paginate(5); // Paginasi 5 item per halaman
        } else {
            // Jika tidak ada parameter search, ambil semua data pasien
            $data_pasien = DB::table('users')
                ->join('pasien', 'users.id_pengguna', '=', 'pasien.id_pengguna')
                ->paginate(5); // Paginasi 5 item per halaman
        }

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data pasien',
            'data' => $data_pasien
        ], 200); // Kode status HTTP 200 untuk 'OK'
    }

    public function updatePasien(Request $request, $id_pasien)
    {
        // Mencari data pasien berdasarkan id_pasien
        $pasien = PasienModel::where('id_pasien', $id_pasien)->first();

        // Jika pasien tidak ditemukan, kembalikan response error
        if (!$pasien) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pasien tidak ditemukan'
            ], 404); // Kode status HTTP 404 untuk 'Not Found'
        }

        $id_pengguna = $pasien->id_pengguna; // Ambil id_pengguna yang terkait

        // Validasi input untuk pembaruan. 'nullable' berarti field tidak harus ada di request.
        $request->validate([
            'username' => 'max:100|unique:users,username,' . $id_pengguna . ',id_pengguna', // Unik, kecuali untuk id_pengguna ini
            'nama' => 'max:100',
            'email' => 'email|unique:users,email,' . $id_pengguna . ',id_pengguna', // Unik, kecuali untuk id_pengguna ini
            'password' => 'nullable|min:3', // Password opsional, minimal 3 karakter jika disediakan
            'no_rm' => 'nullable|numeric|unique:pasien,no_rm,' . $id_pasien . ',id_pasien', // Unik, kecuali untuk id_pasien ini
            'tempat_lahir' => 'max:100',
            'tanggal_lahir' => 'date',
            'jenis_kelamin' => 'in:Laki-laki,Perempuan',
            'alamat' => 'max:255',
            'provinsi' => 'max:100',
            'kabupaten' => 'max:100',
            'kecamatan' => 'max:100',
            'kelurahan' => 'max:100',
            'no_telp' => 'max:15|unique:pasien,no_telp,' . $id_pasien . ',id_pasien',
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:3096' // Foto opsional
        ]);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Memastikan pasien masih ada setelah validasi (jika ada kondisi race)
            $pasien = PasienModel::where('id_pasien', $id_pasien)->first();
            if (!$pasien) {
                throw new \Exception('Pasien tidak ditemukan');
            }

            $id_pengguna = $pasien->id_pengguna; // Dapatkan kembali id_pengguna jika diperlukan

            // Data untuk tabel 'users', hanya tambahkan jika ada di request
            $dataUser = [];
            if ($request->has('username')) {
                $dataUser['username'] = $request->input('username');
            }
            if ($request->has('email')) {
                $dataUser['email'] = $request->input('email');
            }
            // Periksa apakah password diinputkan, jika ada maka update password
            if ($request->filled('password')) {
                $dataUser['password'] = Hash::make($request->input('password'));
            }

            // Data untuk tabel 'pasien', hanya tambahkan jika ada di request
            $dataPasien = [];
            if ($request->has('no_rm')) {
                $dataPasien['no_rm'] = $request->input('no_rm');
            }
            if ($request->has('nama')) {
                $dataPasien['nama'] = $request->input('nama');
            }
            if ($request->has('alamat')) {
                $dataPasien['alamat'] = $request->input('alamat');
            }
            if ($request->has('jenis_kelamin')) {
                $dataPasien['jenis_kelamin'] = $request->input('jenis_kelamin');
            }
            if ($request->has('tempat_lahir')) {
                $dataPasien['tempat_lahir'] = $request->input('tempat_lahir');
            }
            if ($request->has('tanggal_lahir')) {
                $dataPasien['tanggal_lahir'] = $request->input('tanggal_lahir');
            }
            if ($request->has('provinsi')) {
                $dataPasien['provinsi'] = $request->input('provinsi');
            }
            if ($request->has('kabupaten')) {
                $dataPasien['kabupaten'] = $request->input('kabupaten');
            }
            if ($request->has('kecamatan')) {
                $dataPasien['kecamatan'] = $request->input('kecamatan');
            }
            if ($request->has('kelurahan')) {
                $dataPasien['kelurahan'] = $request->input('kelurahan');
            }
            if ($request->has('no_telp')) {
                $dataPasien['no_telp'] = $request->input('no_telp');
            }
            // Perbarui email pasien jika email pengguna diupdate
            if ($request->has('email')) {
                $dataPasien['email'] = $request->input('email');
            }

            // Update foto jika ada file foto yang dikirim
            if ($request->hasFile('foto')) {
                // Proses unggah foto baru, mirip dengan saat membuat pasien
                $filenameWithExt = $request->file('foto')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('foto')->getClientOriginalExtension();

                $filenameToStore = uniqid() . '_' . time() . '.' . $extension;
                $path = $request->file('foto')->storeAs('avatars', $filenameToStore);

                $dataPasien['foto'] = $path; // Update path foto di tabel 'pasien'
            }

            // Hanya melakukan update jika ada data yang akan diubah di tabel 'users'
            if (!empty($dataUser)) {
                User::where('id_pengguna', $id_pengguna)->update($dataUser);
            }
            // Hanya melakukan update jika ada data yang akan diubah di tabel 'pasien'
            if (!empty($dataPasien)) {
                PasienModel::where('id_pasien', $id_pasien)->update($dataPasien);
            }

            DB::commit(); // Melakukan commit jika semua operasi berhasil

            // Mengembalikan response JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Data pasien berhasil diperbarui.',
                'data' => [
                    'pasien' => $dataPasien, // Mengembalikan data yang diupdate
                    'user' => $dataUser
                ]
            ], 200); // Kode status HTTP 200 untuk 'OK'
        } catch (\Exception $e) {
            DB::rollback(); // Melakukan rollback jika terjadi kesalahan

            // Mengembalikan response JSON untuk error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data pasien: ' . $e->getMessage()
            ], 500); // Kode status HTTP 500 untuk 'Internal Server Error'
        }
    }

    /**
     * Menghapus data pasien berdasarkan ID.
     * Method ini akan melakukan soft delete pada entri pasien dari tabel 'pasien'
     * dan hard delete pada entri pengguna terkait dari tabel 'users'.
     *
     * @param  int  $id_pasien ID pasien yang akan dihapus
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePasien($id_pasien)
    {
        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Mencari data pasien berdasarkan id_pasien
            $pasien = PasienModel::where('id_pasien', $id_pasien)->first();

            // Jika pasien tidak ditemukan, kembalikan response error
            if (!$pasien) {
                DB::rollback(); // Pastikan rollback jika pasien tidak ditemukan
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pasien tidak ditemukan.'
                ], 404); // Kode status HTTP 404 untuk 'Not Found'
            }

            $id_pengguna = $pasien->id_pengguna; // Ambil id_pengguna yang terkait

            // Melakukan soft delete pada data dari tabel 'pasien'
            // Karena PasienModel menggunakan SoftDeletes, method delete() akan melakukan soft delete
            $delete_pasien = $pasien->delete();
            
            // Menghapus data dari tabel 'users' yang terkait secara permanen (hard delete)
            $delete_pengguna = User::where('id_pengguna', $id_pengguna)->delete();

            // Memeriksa apakah kedua operasi penghapusan berhasil
            if ($delete_pasien && $delete_pengguna) {
                DB::commit(); // Melakukan commit jika kedua operasi berhasil
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pasien berhasil dihapus'
                ], 200); // Kode status HTTP 200 untuk 'OK'
            } else {
                DB::rollback(); // Melakukan rollback jika salah satu atau kedua operasi gagal
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus pasien.'
                ], 500); // Kode status HTTP 500 untuk 'Internal Server Error'
            }
        } catch (\Exception $e) {
            DB::rollback(); // Pastikan rollback jika terjadi kesalahan lain selama proses
            // Menangani kesalahan jika terjadi selama eksekusi
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500); // Kode status HTTP 500 untuk 'Internal Server Error'
        }
    }

    public function getPasienHasilScan(){
        $user = Auth::user();
        $data_pasien = PasienModel::where('id_pengguna', $user->id_pengguna)->first();
        $data_pemeriksaan = PemeriksaanAkhirModel::where('id_pasien', $data_pasien->id_pasien)
            ->orderBy('created_at', 'desc')
            ->first();
        $data_pemeriksaan->dokter = $data_pemeriksaan->dokter()->first();
        $data_minum_obat = RiwayatMinumObatModel::where('id_pasien', $data_pasien->id_pasien)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data hasil scan pasien',
            'data' => compact('data_pasien', 'data_pemeriksaan', 'data_minum_obat')
        ], 200);
    }
    public function getDaftarObat(){
        $user = Auth::user();
        $data_pasien = PasienModel::where('id_pengguna', $user->id_pengguna)->first();
        $data_resep = ResepModel::where('id_pasien', $data_pasien->id_pasien)
            ->latest()
            ->first();
        if($data_resep->status_diserahkan == 'belum_diserahkan'){
            $data_obat = [];
        } else {
            $racikanQuery = obatRacikanModel::where('id_pasien', $data_pasien->id_pasien);
            $obatRacikan = $racikanQuery->get()->map(function($item) {
                return [
                    'tipe_obat' => 'racikan',
                    'detail_obat' => $item->toArray(),
                ];
            })->values();
            $obatRacikan = collect($obatRacikan->all()); 
            $nonRacikanQuery = obatNonRacikanModel::where('obat_non_racikan.id_pasien', $data_pasien->id_pasien)
                ->leftJoin('obat', 'obat_non_racikan.kode_obat', '=', 'obat.kode_obat')
                ->select(
                    'obat_non_racikan.*',
                    'obat.nama_obat',
                    'obat.takaran_minum',
                    'obat.jml_kali_minum',
                    'obat.jml_obat_per_minum',
                    'obat.kemasan_obat',
                    'obat.aturan_pakai',
                    'obat.golongan_obat',
                    'obat.jumlah_obat',
                    'obat.waktu_minum',
                    'obat.keterangan',
                    'obat.kontraindikasi',
                    'obat.pola_makan',
                    'obat.interaksi_obat',
                    'obat.petunjuk_penyimpanan',
                    'obat.kekuatan_sediaan',
                    'obat.informasi_tambahan',
                    'obat.efek_samping',
                    'obat.indikasi',
                    'obat.status_ketersediaan_obat'
                );
            $obatNonRacikan = $nonRacikanQuery->get()->map(function($item) {
                return [
                    'tipe_obat' => 'non_racikan',
                    'detail_obat' => $item->toArray(),
                ];
            })->values(); 
            $obatNonRacikan = collect($obatNonRacikan->all()); 


            $data_obat = $obatRacikan->merge($obatNonRacikan)->sortBy(function($item) {
                return $item['detail_obat']['created_at'] ?? '0';
            })->values();

            
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data daftar obat pasien',
            'data' => compact('data_pasien', 'data_resep', 'data_obat')
        ], 200);
    }
    public function getObatDetail(Request $request, $id)
    {
        $tipeObat = $request->query('tipe_obat');
        $detailObat = null;
        $resepDetail = null;

        try {
            $pasien = PasienModel::where('id_pengguna', Auth::user()->id_pengguna)->first();
            $resepDetail = ResepModel::where('id_pasien',  $pasien->id_pasien)
                ->latest()
                ->first();

            if (!$resepDetail) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Detail resep tidak ditemukan untuk ID dan tipe tersebut.'
                ], 404);
            }

            // Dapatkan detail obat berdasarkan tipe
            if ($tipeObat === 'racikan') {
                $detailObat = obatRacikanModel::where('id_obat_racikan', '=', $id)->first(); // Asumsi id_obat di resep_detail menunjuk ke id di obat_racikan
                if ($detailObat) {
                    $detailObat->nama_obat_racikan = $detailObat->nama_racikan; // Konsistensi penamaan
                }
            } elseif ($tipeObat === 'non_racikan') {
                $detailObat = obatNonRacikanModel::where('id_obat_non_racikan', '=', $id)->first();// Asumsi id_obat di resep_detail menunjuk ke id di obat_non_racikan
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tipe obat tidak valid.'
                ], 400);
            }

            if (!$detailObat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data obat detail tidak ditemukan.'
                ], 404);
            }

            
            
            // Gabungkan data yang dibutuhkan
            $dataResponse = [
                'id_resep_detail' => $resepDetail->id_resep, 
                'tipe_obat' => $tipeObat,
                'detail_obat' => $detailObat,
            ];

            if($tipeObat == 'non_racikan') {
               $obatData = ObatModel::where('kode_obat', $detailObat->kode_obat)->first();
               $dataResponse['detail_obat']->nama_obat = $obatData->nama_obat;
            }

            return response()->json([
                'status' => 'success',
                'data' => $dataResponse
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server saat mengambil detail obat: ' . $e->getMessage()
            ], 500);
        }
    }

    public function simpanJadwalMinum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'obat_id' => 'required',
            'tipe_obat' => 'required|in:racikan,non_racikan',
            'waktu_minum' => 'required|string', // Akan datang sebagai string JSON
            'tanggal_mulai' => 'required|date',
            'kirim_notifikasi' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        try {
            $obatId = $request->input('obat_id');
            $tipeObat = $request->input('tipe_obat');
            $waktuMinumRaw = $request->input('waktu_minum');
            $tanggalMulai = $request->input('tanggal_mulai');
            $kirimNotifikasi = $request->boolean('kirim_notifikasi');

            $waktuMinumArray = json_decode($waktuMinumRaw, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
               
                return response()->json([
                    'status' => 'error',
                    'message' => 'Format waktu minum tidak valid.',
                ], 400);
            }
            $pasien = PasienModel::where('id_pengguna', Auth::user()->id_pengguna)->first();

            $nama_obat = "";
            $aturan_pakai = "";

            if($tipeObat == "racikan"){
                $obat = obatRacikanModel::find($obatId);
                if(!$obat){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data obat detail tidak ditemukan.'
                    ], 404);
                }
                $nama_obat = $obat->nama_racikan;
                $aturan_pakai = $obat->takaran_obat . " | " . $obat->instruksi_pemakaian;
            } else {
                $obat = obatNonRacikanModel::find($obatId);
                if(!$obat){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data obat detail tidak ditemukan.'
                    ], 404);
                }
                $obat = $obat->first();
                $obatDetail = ObatModel::where('kode_obat', $obat->kode_obat)->first();
                $nama_obat = $obatDetail->nama_obat;
                $aturan_pakai = $obat->signatura;
            }

            foreach ($waktuMinumArray as $waktu) {
                RiwayatMinumObatModel::create([
                    'id_pasien' => $pasien->id_pasien,
                    'kode_obat' => $obatId,
                    'jenis_obat' => $tipeObat,
                    'nama_obat' => $nama_obat,
                    'aturan_pakai' => $aturan_pakai,
                    'tanggal_minum' => $tanggalMulai,
                    'jam_minum' => $waktu,
                    'notifikasi' => $kirimNotifikasi ? 1 : 0,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Jadwal minum berhasil disimpan.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getProfile()
    {
        $user = Auth::user();
        $data_pasien = PasienModel::where('id_pengguna', $user->id_pengguna)->first();
        if (!$data_pasien) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data profil pasien.',
            'data' => $data_pasien
        ], 200);
    }
    public function getPasienById(Request $request, $id)
    {
        $data_pasien = PasienModel::where('id_pasien', $id)->first();
        if (!$data_pasien) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data profil pasien.',
            'data' => $data_pasien
        ], 200);
    }
    public function getPasienByIdPemeriksaanAwal(Request $request, $id)
    {
        $pemeriksaanAwal = PemeriksaanAwalModel::where('id_pemeriksaan_awal', '=', $id)->first();
        $data_pasien = PasienModel::where('id_pasien', $pemeriksaanAwal->id_pasien)->first();
        if (!$data_pasien) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data profil pasien.',
            'data' => $data_pasien
        ], 200);
    }
    public function getPasienByIdPemeriksaanAkhir(Request $request, $id)
    {
        $pemeriksaanAkhir = PemeriksaanAkhirModel::where('id_pemeriksaan_akhir', '=', $id)->first();
        $data_pasien = PasienModel::where('id_pasien', $pemeriksaanAkhir->id_pasien)->first();
        if (!$data_pasien) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data profil pasien.',
            'data' => $data_pasien
        ], 200);
    }
    public function updateJadwalMinumStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:sudah_minum,tunda_minum,tidak_minum',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        try {
            $jadwal = RiwayatMinumObatModel::find($id);

            if (!$jadwal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal minum obat tidak ditemukan.'
                ], 404); // Not Found
            }

            $jadwal->status = $request->input('status');
            $jadwal->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status minum obat berhasil diperbarui.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500); // Internal Server Error
        }
    }
}
