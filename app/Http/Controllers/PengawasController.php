<?php

namespace App\Http\Controllers;

use App\Models\PengawasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengawasController extends Controller
{
    public function index(){
        $data_pengawas =  DB::table('users')
        ->join('pengawas', 'users.id_pengguna', '=', 'pengawas.id_pengguna')
        ->select('users.*', 'pengawas.*')
        ->paginate(5);
    // dd($data_pengawas);

    return view('admin.jumlah-pengawas', compact('data_pengawas'));
    }

    public function tambahpengawas() {
        return view('admin.tambah-pengawas');
    }

    public function pengawasStore(Request $request) {
        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Data untuk tabel User
            $userData = [
                'id_role' => 'R04',
                'nama_role' => 'pengawas',
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            $user = User::create($userData); // Simpan data ke tabel User

            // Data untuk tabel Apoteker (menggunakan id_user dari tabel User)
            $apotekerData = [
                'id_pengguna' => $user->id_pengguna, // Menggunakan ID yang baru dibuat dari tabel User
                'kode_klinik' => '1',
                'nama_pengawas' => $request->input('nama_pengawas'),
                'email' => $user->email,
            ];
            PengawasModel::create($apotekerData); // Simpan data ke tabel Apoteker

            DB::commit(); // Jika semua operasi berhasil, lakukan commit
            return redirect()->route('jumlah-pengawas')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
            return redirect()->route('jumlah-pengawas')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function pengawasupdate(Request $request, $id) {
        // $coba = ApotekerModel::where('id_pengguna', '=', 3)->first();
        // dd($id_apoteker);
        // dd($id_apoteker); variabel id_apoteker sudah berhasil mendapatkan id apotekernya
        // kalo misalkan mau mendapatkan id_pengguna tinggal diganti aja
        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Data untuk tabel Pasien
            // $coba = ApotekerModel::where('id_pengguna', '=', 3)->first();
            // dd($coba);

            $coba1 = PengawasModel::where('id_pengawas', '=', $id)->first();
            $id_pengguna = $coba1->id_pengguna;
            // dd($coba1);

            $dataUser = [
                'username' => $request->input('username'),
                // 'email' => $request->input('email'),
                // 'password' => Hash::make($request->input('password')),
            ];

            // Data untuk tabel DetailPasien
            $dataPengawas = [
                'nama_pengawas' => $request->input('nama_pengawas'),
            ];

            // Update data pada tabel Pasien
            PengawasModel::where('id_pengawas', $id)->update($dataPengawas);

            // Update data pada tabel DetailPasien
            User::where('id_pengguna', $id_pengguna)->update($dataUser);

            DB::commit(); // Jika semua operasi berhasil, lakukan commit
            return redirect()->route('jumlah-pengawas')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
            return redirect()->route('jumlah-pengawas')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function pengawasdestroy($id){
        $delete_pengawas = PengawasModel::where('id_pengawas', $id)->delete();
        if ($delete_pengawas){
            return back();
        };
    }
}
