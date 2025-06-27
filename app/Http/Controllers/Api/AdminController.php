<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\PengawasModel;
use App\Models\ResepsionisModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\ApotekerModel;
use Illuminate\Support\Facades\Storage;
use Log;

class AdminController extends Controller
{
    // Apoteker
    public function createApoteker(Request $request)
    {
        $request->validate([
            'username' => 'required|max:100|unique:users,username',
            'nama_apoteker' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'foto' => 'required|mimes:jpeg,jpg,png|max:3096'
        ]);
        if ($request->hasFile('foto')) {
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();

            $basename = uniqid() . time();
            $filenameSimpan =  $filename . '_' . time() . '_' . $extension;
            $path = $request->file('foto')->storeAs('avatars', $filenameSimpan);
        } else {
            $path = 'avatars/noimage.png';
        }

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Data untuk tabel User
            $userData = [
                'id_role' => 'R03',
                'nama_role' => 'apoteker',
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            $user = User::create($userData); // Simpan data ke tabel User

            // dd($user);

            // Data untuk tabel Apoteker (menggunakan id_user dari tabel User)
            $apotekerData = [
                'id_pengguna' => $user->id_pengguna, // Menggunakan ID yang baru dibuat dari tabel User
                'nama_apoteker' => $request->input('nama_apoteker'),
                'email' => $user->email,
                'foto' => $path
            ];
            ApotekerModel::create($apotekerData); // Simpan data ke tabel Apoteker

            DB::commit(); // Jika semua operasi berhasil, lakukan commit
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan.',
                'data' => [
                    'user' => $user,
                    'apoteker' => $apotekerData
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getApoteker(Request $request)
    {
        if ($request->has('page')) {
            $page = $request->input('page');
        }
        // Mengecek apakah ada parameter 'search' pada request
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_apoteker = DB::table('users')
                ->join('apoteker', 'users.id_pengguna', '=', 'apoteker.id_pengguna')
                ->orWhere('users.username', 'like', "%" . $search . "%")
                ->orWhere('apoteker.nama_apoteker', 'like', "%" . $search . "%")
                ->orWhere('users.email', 'like', "%" . $search . "%")
                ->paginate(5);
        } else {
            $data_apoteker = DB::table('users')
                ->join('apoteker', 'users.id_pengguna', '=', 'apoteker.id_pengguna')
                ->paginate(5);
        }

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data',
            'data' => $data_apoteker
        ], 200);
    }
    public function updateApoteker(Request $request, $id)
    {
        // Validasi input
        $apoteker = ApotekerModel::where('id_apoteker', $id)->first();

        if (!$apoteker) {
            return response()->json([
                'status' => 'error',
                'message' => 'Apoteker tidak ditemukan'
            ], 404);
        }

        $id_pengguna = $apoteker->id_pengguna;
        $request->validate([
            'username' => 'max:100|unique:users,username,' . $id_pengguna . ',id_pengguna', // Validate username uniqueness, but exclude current one
            'nama_apoteker' => 'max:100',
            'email' => 'email|unique:users,email,' . $id_pengguna . ',id_pengguna', // Validate email uniqueness, but exclude current one
            'password' => 'nullable|min:3', // Password optional, must be at least 3 characters if provided
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:3096' // Foto optional, validate if provided
        ]);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Mengambil data apoteker berdasarkan id
            $apoteker = ApotekerModel::where('id_apoteker', $id)->first();
            if (!$apoteker) {
                throw new \Exception('Apoteker tidak ditemukan');
            }

            $id_pengguna = $apoteker->id_pengguna; // Ambil id_pengguna untuk update tabel users

            // Data untuk tabel User (update username, password)
            $dataUser = [
                'username' => $request->input('username'),
            ];

            // Periksa apakah password diinputkan, jika ada maka update password
            if ($request->filled('password')) {
                $dataUser['password'] = Hash::make($request->input('password'));
            }

            // Data untuk tabel Apoteker (update nama_apoteker)
            $dataApoteker = [
                'nama_apoteker' => $request->input('nama_apoteker'),
            ];

            // Update foto jika ada file foto yang dikirim
            if ($request->hasFile('foto')) {
                // Proses upload foto baru
                $filenameWithExt = $request->file('foto')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('foto')->getClientOriginalExtension();

                $filenameToStore = uniqid() . '_' . time() . '.' . $extension;
                $path = $request->file('foto')->storeAs('avatars', $filenameToStore);

                $dataApoteker['foto'] = $path; // Update foto di tabel Apoteker
            }

            // Update data di tabel User (username, password)
            User::where('id_pengguna', $id_pengguna)->update($dataUser);

            // Update data di tabel Apoteker (nama_apoteker, foto)
            ApotekerModel::where('id_apoteker', $id)->update($dataApoteker);

            DB::commit(); // Jika semua operasi berhasil, lakukan commit

            // Mengembalikan response JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui.',
                'data' => [
                    'apoteker' => $dataApoteker,
                    'user' => $dataUser
                ]
            ], 200);
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan

            // Mengembalikan response JSON untuk error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteApoteker($id)
    {
        try {
            // Menghapus data apoteker berdasarkan id
            $apoteker = ApotekerModel::where('id_apoteker', $id);
            $pengguna = User::where('id_pengguna', $apoteker->first()->id_pengguna);
            $delete_apoteker = $apoteker->delete();
            $delete_pengguna = $pengguna->delete();

            // Memeriksa apakah penghapusan berhasil
            if ($delete_apoteker && $delete_pengguna) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Apoteker berhasil dihapus.'
                ], 200); // Kode status HTTP 200 menunjukkan bahwa permintaan berhasil
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Apoteker tidak ditemukan atau gagal dihapus.'
                ], 404); // Kode status HTTP 404 menunjukkan tidak ditemukan
            }
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500); // Kode status HTTP 500 menunjukkan kesalahan server
        }
    }




    public function createResepsionis(Request $request)
    {
        $request->validate([
            'username' => 'required|max:100|unique:users,username',
            'nama_resepsionis' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'foto' => 'required|mimes:jpeg,jpg,png|max:3096'
        ]);
        if ($request->hasFile('foto')) {
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();

            $basename = uniqid() . time();
            $filenameSimpan =  $filename . '_' . time() . '_' . $extension;
            $path = $request->file('foto')->storeAs('avatars', $filenameSimpan);
        } else {
            $path = 'avatars/noimage.png';
        }

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Data untuk tabel User
            $userData = [
                'id_role' => 'R06',
                'nama_role' => 'resepsionis',
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            $user = User::create($userData); // Simpan data ke tabel User

            // dd($user);

            // Data untuk tabel resepsionis (menggunakan id_user dari tabel User)
            $resepsionisData = [
                'id_pengguna' => $user->id_pengguna, // Menggunakan ID yang baru dibuat dari tabel User
                'nama_resepsionis' => $request->input('nama_resepsionis'),
                'email' => $user->email,
                'foto' => $path
            ];
            ResepsionisModel::create($resepsionisData); // Simpan data ke tabel resepsionis

            DB::commit(); // Jika semua operasi berhasil, lakukan commit
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan.',
                'data' => [
                    'user' => $user,
                    'resepsionis' => $resepsionisData
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getResepsionis(Request $request)
    {
        // Memulai query builder
        $query = DB::table('users')
            ->join('resepsionis', 'users.id_pengguna', '=', 'resepsionis.id_pengguna');

        // Mengecek apakah ada parameter 'search' pada request
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');

            // Mengelompokkan kondisi WHERE untuk pencarian agar logikanya benar
            $query->where(function ($q) use ($search) {
                $q->where('users.username', 'like', "%" . $search . "%")
                    ->orWhere('resepsionis.nama_resepsionis', 'like', "%" . $search . "%")
                    ->orWhere('users.email', 'like', "%" . $search . "%");
            });
        }

        // Menjalankan pagination pada query yang sudah difilter (atau belum jika tidak ada search)
        $data_resepsionis = $query->paginate(5);

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data',
            'data' => $data_resepsionis
        ], 200);
    }
    public function updateResepsionis(Request $request, $id)
    {
        // Validasi input
        $resepsionis = ResepsionisModel::where('id_resepsionis', $id)->first();

        if (!$resepsionis) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resepsionis tidak ditemukan'
            ], 404);
        }

        $id_pengguna = $resepsionis->id_pengguna;
        $request->validate([
            'username' => 'max:100|unique:users,username,' . $id_pengguna . ',id_pengguna', // Validate username uniqueness, but exclude current one
            'nama_resepsionis' => 'max:100',
            'email' => 'email|unique:users,email,' . $id_pengguna . ',id_pengguna', // Validate email uniqueness, but exclude current one
            'password' => 'nullable|min:3', // Password optional, must be at least 3 characters if provided
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:3096' // Foto optional, validate if provided
        ]);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Mengambil data resepsionis berdasarkan id
            $resepsionis = ResepsionisModel::where('id_resepsionis', $id)->first();
            if (!$resepsionis) {
                throw new \Exception('resepsionis tidak ditemukan');
            }

            $id_pengguna = $resepsionis->id_pengguna; // Ambil id_pengguna untuk update tabel users

            // Data untuk tabel User (update username, password)
            $dataUser = [
                'username' => $request->input('username'),
            ];

            // Periksa apakah password diinputkan, jika ada maka update password
            if ($request->filled('password')) {
                $dataUser['password'] = Hash::make($request->input('password'));
            }

            // Data untuk tabel resepsionis (update nama_resepsionis)
            $dataresepsionis = [
                'nama_resepsionis' => $request->input('nama_resepsionis'),
            ];

            // Update foto jika ada file foto yang dikirim
            if ($request->hasFile('foto')) {
                // Proses upload foto baru
                $filenameWithExt = $request->file('foto')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('foto')->getClientOriginalExtension();

                $filenameToStore = uniqid() . '_' . time() . '.' . $extension;
                $path = $request->file('foto')->storeAs('avatars', $filenameToStore);

                $dataresepsionis['foto'] = $path; // Update foto di tabel resepsionis
            }

            // Update data di tabel User (username, password)
            User::where('id_pengguna', $id_pengguna)->update($dataUser);

            // Update data di tabel resepsionis (nama_resepsionis, foto)
            ResepsionisModel::where('id_resepsionis', $id)->update($dataresepsionis);

            DB::commit(); // Jika semua operasi berhasil, lakukan commit

            // Mengembalikan response JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui.',
                'data' => [
                    'resepsionis' => $dataresepsionis,
                    'user' => $dataUser
                ]
            ], 200);
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan

            // Mengembalikan response JSON untuk error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteResepsionis($id)
    {
        try {
            // Menghapus data apoteker berdasarkan id
            $resepsionis = ResepsionisModel::where('id_resepsionis', $id);
            $pengguna = User::where('id_pengguna', $resepsionis->first()->id_pengguna);
            $delete_resepsionis = $resepsionis->delete();
            $delete_pengguna = $pengguna->delete();

            // Memeriksa apakah penghapusan berhasil
            if ($delete_resepsionis && $delete_pengguna) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Resepsionis berhasil dihapus.'
                ], 200); // Kode status HTTP 200 menunjukkan bahwa permintaan berhasil
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Resepsionis tidak ditemukan atau gagal dihapus.'
                ], 404); // Kode status HTTP 404 menunjukkan tidak ditemukan
            }
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500); // Kode status HTTP 500 menunjukkan kesalahan server
        }
    }


    // public function createDokter(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|max:100|unique:users,username',
    //         'nama_dokter' => 'required|max:100',
    //         'jenis_dokter' => 'required|max:100',
    //         'spesialis' => 'required|max:100',
    //         'kode_dokter' => 'required|max:7',
    //         'kode_bpjs' => 'required|max:7',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:3',
    //         'foto' => 'required|mimes:jpeg,jpg,png|max:3096'
    //     ]);
    //     if ($request->hasFile('foto')) {
    //         $filenameWithExt = $request->file('foto')->getClientOriginalName();
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         $extension = $request->file('foto')->getClientOriginalExtension();

    //         $basename = uniqid() . time();
    //         $filenameSimpan =  $filename . '_' . time() . '_' . $extension;
    //         $path = $request->file('foto')->storeAs('avatars', $filenameSimpan);
    //     } else {
    //         $path = 'avatars/noimage.png';
    //     }

    //     DB::beginTransaction(); // Memulai transaksi database

    //     try {
    //         // Data untuk tabel User
    //         $userData = [
    //             'id_role' => 'R02',
    //             'nama_role' => 'dokter',
    //             'username' => $request->input('username'),
    //             'email' => $request->input('email'),
    //             'password' => Hash::make($request->input('password')),
    //         ];
    //         $user = User::create($userData); // Simpan data ke tabel User

    //         // Data untuk tabel Apoteker (menggunakan id_user dari tabel User)
    //         $dokterData = [
    //             'id_pengguna' => $user->id, // Menggunakan ID yang baru dibuat dari tabel User
    //             'kode_klinik' => '1',
    //             'nama_dokter' => $request->input('nama_dokter'),
    //             'jenis_dokter' => $request->input('jenis_dokter'),
    //             'kode_dokter' => $request->input('kode_dokter'),
    //             'kode_bpjs' => $request->input('kode_bpjs'),
    //             'spesialis' => $request->input('spesialis'),
    //             'email' => $user->email,
    //             'foto' => $path
    //         ];
    //         DokterModel::create($dokterData); // Simpan data ke tabel dokter

    //         DB::commit(); // Jika semua operasi berhasil, lakukan commit
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Data berhasil ditambahkan.',
    //             'data' => [
    //                 'user' => $user,
    //                 'dokter' => $dokterData
    //             ]
    //         ], 201);
    //     } catch (\Exception $e) {
    //         DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Gagal menambahkan data',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function createDokter(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'nama_dokter' => 'required',
            'jenis_dokter' => 'required',
            'spesialis' => 'required',
            'kode_dokter' => 'required',
            'kode_bpjs' => 'required',
            'email' => 'required|email|unique:users,email', // Tambahkan validasi email unik
            'password' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Tambahkan validasi file
        ]);

        $path = 'avatars/noimage.png'; // Default path
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filenameSimpan = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/avatars', $filenameSimpan); // Simpan ke public/avatars
            $path = 'avatars/' . $filenameSimpan; // Path untuk disimpan di DB
        }

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Data untuk tabel User
            $userData = [
                'id_role' => 'R02',
                'nama_role' => 'dokter',
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            $user = User::create($userData); // Simpan data ke tabel User

            // Data untuk tabel Dokter
            $dokterData = [
                // --- PERBAIKAN DI SINI ---
                'id_pengguna' => $user->id_pengguna, // Menggunakan Primary Key yang benar (id_pengguna)

                'kode_klinik' => '1',
                'nama_dokter' => $request->input('nama_dokter'),
                'jenis_dokter' => $request->input('jenis_dokter'),
                'kode_dokter' => $request->input('kode_dokter'),
                'kode_bpjs' => $request->input('kode_bpjs'),
                'spesialis' => $request->input('spesialis'),
                'email' => $user->email,
                'foto' => $path
            ];
            // Pastikan model Dokter Anda bernama DokterModel
            DokterModel::create($dokterData); // Simpan data ke tabel dokter

            DB::commit(); // Jika semua operasi berhasil, lakukan commit
            return response()->json([
                'status' => 'success',
                'message' => 'Data dokter berhasil ditambahkan.',
                'data' => [
                    'user' => $user,
                    'dokter' => $dokterData
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan

            // Hapus file yang sudah terupload jika transaksi gagal
            if ($request->hasFile('foto') && isset($filenameSimpan)) {
                Storage::delete('public/avatars/' . $filenameSimpan);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data. Terjadi kesalahan pada server.',
                // Kirim pesan error yang sebenarnya untuk debugging
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getDokter(Request $request)
    {
        if ($request->has('page')) {
            $page = $request->input('page');
        }
        // Mengecek apakah ada parameter 'search' pada request
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

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data',
            'data' => $data_dokter
        ], 200);
    }
    public function updateDokter(Request $request, $id)
    {
        // Validasi input
        $dokter = DokterModel::where('id_dokter', $id)->first();

        if (!$dokter) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dokter tidak ditemukan'
            ], 404);
        }

        $id_pengguna = $dokter->id_pengguna;
        $request->validate([
            'username' => 'max:100|unique:users,username,' . $id_pengguna . ',id_pengguna', // Validate username uniqueness, but exclude current one
            'nama_dokter' => 'max:100',
            'jenis_dokter' => 'max:100',
            'spesialis' => 'max:100',
            'kode_dokter' => 'max:7',
            'kode_bpjs' => 'max:7',
            'email' => 'email|unique:users,email,' . $id_pengguna . ',id_pengguna', // Validate email uniqueness, but exclude current one
            'password' => 'nullable|min:3', // Password optional, must be at least 3 characters if provided
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:3096' // Foto optional, validate if provided
        ]);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Mengambil data dokter berdasarkan id
            $dokter = DokterModel::where('id_dokter', $id)->first();
            if (!$dokter) {
                throw new \Exception('Dokter tidak ditemukan');
            }

            $id_pengguna = $dokter->id_pengguna; // Ambil id_pengguna untuk update tabel users

            // Data untuk tabel User (update username, password)
            $dataUser = [
                'username' => $request->input('username'),
            ];

            // Periksa apakah password diinputkan, jika ada maka update password
            if ($request->filled('password')) {
                $dataUser['password'] = Hash::make($request->input('password'));
            }

            // Data untuk tabel dokter (update nama_dokter)
            $datadokter = [
                'nama_dokter' => $request->input('nama_dokter'),
                'jenis_dokter' => $request->input('jenis_dokter'),
                'kode_dokter' => $request->input('kode_dokter'),
                'kode_bpjs' => $request->input('kode_bpjs'),
                'spesialis' => $request->input('spesialis')
            ];

            // Update foto jika ada file foto yang dikirim
            if ($request->hasFile('foto')) {
                // Proses upload foto baru
                $filenameWithExt = $request->file('foto')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('foto')->getClientOriginalExtension();

                $filenameToStore = uniqid() . '_' . time() . '.' . $extension;
                $path = $request->file('foto')->storeAs('avatars', $filenameToStore);

                $datadokter['foto'] = $path; // Update foto di tabel dokter
            }

            // Update data di tabel User (username, password)
            User::where('id_pengguna', $id_pengguna)->update($dataUser);

            // Update data di tabel dokter (nama_dokter, foto)
            DokterModel::where('id_dokter', $id)->update($datadokter);

            DB::commit(); // Jika semua operasi berhasil, lakukan commit

            // Mengembalikan response JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui.',
                'data' => [
                    'dokter' => $datadokter,
                    'user' => $dataUser
                ]
            ], 200);
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan

            // Mengembalikan response JSON untuk error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteDokter($id)
    {
        try {
            // Menghapus data dokter berdasarkan id
            $dokter = DokterModel::where('id_dokter', $id);
            $pengguna = User::where('id_pengguna', $dokter->first()->id_pengguna);
            $delete_dokter = $dokter->delete();
            $delete_pengguna = $pengguna->delete();

            // Memeriksa apakah penghapusan berhasil
            if ($delete_dokter && $delete_pengguna) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Dokter berhasil dihapus.'
                ], 200); // Kode status HTTP 200 menunjukkan bahwa permintaan berhasil
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Dokter tidak ditemukan atau gagal dihapus.'
                ], 404); // Kode status HTTP 404 menunjukkan tidak ditemukan
            }
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500); // Kode status HTTP 500 menunjukkan kesalahan server
        }
    }
}
