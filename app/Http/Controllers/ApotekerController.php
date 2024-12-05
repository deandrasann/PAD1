<?php

namespace App\Http\Controllers;

use App\Models\ApotekerModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApotekerController extends Controller
{
    public function index(Request $request)
    {
        // $data_apoteker = DB::table('users')
        //     ->join('apoteker', 'users.id_pengguna', '=', 'apoteker.id_pengguna')
        //     ->select('users.*', 'apoteker.*')
        //     ->paginate(5);
        // dd($data_apoteker);
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_apoteker = DB::table('users')
            ->join('apoteker', 'users.id_pengguna', '=', 'apoteker.id_pengguna')
            ->orWhere('users.username', 'like',"%" . $search . "%")
            ->orWhere('apoteker.nama_apoteker', 'like',"%" . $search . "%")
            ->orWhere('users.email', 'like',"%" . $search . "%")
            ->paginate(5);
        } else {
            $data_apoteker = DB::table('users')
            ->join('apoteker', 'users.id_pengguna', '=', 'apoteker.id_pengguna')
            ->paginate(5);
        }
        // $data = DB::table('users')
        // ->join('apoteker', 'users.id_pengguna', '=', 'apoteker.id_pengguna')->get();
        // dd($data);

        return view('admin.jumlah-apoteker', compact('data_apoteker'));
    }

    public function tambahApoteker()
    {
        return view('admin.tambah-apoteker');
    }

    public function ApotekerStore(Request $request)
    {
        $request->validate([ 
            'username' => 'required|max:100',
            'nama_apoteker' => 'required|max:100',
            'email' => 'required|email',
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
            return redirect()->route('jumlah-apoteker')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
            return redirect()->route('jumlah-apoteker')->with('error', 'Gagal menambahkan data');
        }
    }

    public function ApotekerUpdate(Request $request, $id)
    {
        $request->validate([ 
            'username' => 'required|max:100',
            'nama_apoteker' => 'required|max:100',
            'foto' => 'required|mimes:jpeg,jpg,png|max:3096'
            ]);
        // $coba = ApotekerModel::where('id_pengguna', '=', 3)->first();
        // dd($id_apoteker);
        // dd($id_apoteker); variabel id_apoteker sudah berhasil mendapatkan id apotekernya
        // kalo misalkan mau mendapatkan id_pengguna tinggal diganti aja
        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Data untuk tabel Pasien
            // $coba = ApotekerModel::where('id_pengguna', '=', 3)->first();
            // dd($coba);

            $coba1 = ApotekerModel::where('id_apoteker', '=', $id)->first();
            $id_pengguna = $coba1->id_pengguna;
            // dd($coba1);

            $dataPasien = [
                'username' => $request->input('username'),
                // 'email' => $request->input('email'),
                // 'password' => Hash::make($request->input('password')),
            ];

            // Data untuk tabel DetailPasien
            $dataApoteker = [
                'nama_apoteker' => $request->input('nama_apoteker'),
            ];

            // Update data pada tabel Pasien
            ApotekerModel::where('id_apoteker', $id)->update($dataApoteker);

            // Update data pada tabel DetailPasien
            User::where('id_pengguna', $id_pengguna)->update($dataPasien);

            DB::commit(); // Jika semua operasi berhasil, lakukan commit
            return redirect()->route('jumlah-apoteker')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback perubahan
            return redirect()->route('jumlah-apoteker')->with('error', 'Gagal memperbarui data');
        }
    }

    public function ApotekerDestroy($id)
    {
        $delete_apoteker = ApotekerModel::where('id_apoteker', $id)->delete();
        if ($delete_apoteker) {
            return back();
        };
    }
}
