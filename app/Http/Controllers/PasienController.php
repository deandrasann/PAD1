<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index(Request $request) {
        $no_rm = $request->input('no_rm');
        $nama_pasien = $request->input('nama');
        $alamat = $request->input('alamat');
        $tgl_lahir = $request->input('tanggal_lahir');
        // dd($request->all());

        // $data_pasien = PasienModel::where('no_rm', $no_rm)
        //             ->orWhere('nama', 'LIKE', "%{$nama_pasien}%")
        //             ->get();
        if([$no_rm,$nama_pasien,$alamat,$tgl_lahir] !== null) {
        $data_pasien = DB::table('pasien')->where('no_rm', $no_rm,)
                        ->where('nama', 'like',"%" . $nama_pasien . "%")
                        ->where('alamat', 'like',"%" . $alamat . "%")
                        ->where('tanggal_lahir', $tgl_lahir)
                        ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')->get();
        }
        return view('pasien_terdaftar', compact('data_pasien'));
    }

    public function indexAdmin(Request $request) {
        $no_rm = $request->input('no_rm');
        $nama_pasien = $request->input('nama');
        $alamat = $request->input('alamat');
        $tgl_lahir = $request->input('tanggal_lahir');
        // dd($request->all());

        // $data_pasien = PasienModel::where('no_rm', $no_rm)
        //             ->orWhere('nama', 'LIKE', "%{$nama_pasien}%")
        //             ->get();
        if([$no_rm,$nama_pasien,$alamat,$tgl_lahir] !== null) {
        $data_pasien = DB::table('pasien')->where('no_rm', $no_rm,)
                        ->where('nama', 'like',"%" . $nama_pasien . "%")
                        ->where('alamat', 'like',"%" . $alamat . "%")
                        ->where('tanggal_lahir', $tgl_lahir)
                        ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')->get();
        }
        return view('admin.jumlah-pasien', compact('data_pasien'));
    }

    public function pasien(Request $request) {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')
            ->WhereNull('pasien.deleted_at')
            ->orWhere('no_rm', $search)
            ->orWhere('nama', 'like',"%" . $search . "%")
            ->orWhere('jenis_kelamin', 'like',"%" . $search . "%")
            ->orWhere('no_telp', 'like',"%" . $search . "%")
            ->orWhere('alamat', 'like',"%" . $search . "%")
            ->orWhere('tanggal_lahir', $search)
            ->orderBy('nama', 'asc')
            ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->WhereNull('pasien.deleted_at')
                ->orderBy('nama', 'asc')
                ->paginate(5);
        }
        // $data_pasien = DB::table('pasien')->paginate(5);
        return view('daftar-pasien', compact('data_pasien'));
    }

    public function PasienStore(Request $request) {
        $tambah_pasien = PasienModel::insert([
            'no_rm' => $request->input('no_rm'),
            'nama' => $request->input('nama'),
            'id_pengguna' => 1,
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'berat_badan' => $request->input('berat_badan'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'created_at' => now(),
        ]);
        return redirect()->route('daftar-pasien')->with('success', 'Berhasil Menambahkan Pasien');
    }
    public function tambahPasien() {
        return view('admin.tambah-pasien');
    }

    public function PasienUpdate(Request $request, $id) {
        $data = [
            'no_rm' => $request->input('no_rm'),
            'nama' => $request->input('nama'),
            'id_pengguna' => 1,
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_telp' => $request->input('no_telp'),
            'alamat' => $request->input('alamat'),
        ];
        $data_pasien = PasienModel::find($id);
        $upd = PasienModel::where('id_pasien', '=', $data_pasien->id_pasien)->update($data);
        // dd($upd);
        return redirect()->route('daftar-pasien')->with('success', 'berhasil mengubah data');
    }

  public function PasienDestroy($id)
{
    $delete_pasien = PasienModel::where('id_pasien', $id)->first();

    if ($delete_pasien) {
        $delete_pasien->delete(); // soft delete
        return back()->with('success', 'Pasien berhasil dihapus secara soft delete.');
    }

    return back()->with('error', 'Pasien tidak ditemukan.');
}

    public function hasilScan(){
        $data_pasien = PasienModel::where('id_pengguna', auth()->user()->id_pengguna)->first();

        return view('pasien.hasil-scan-pasien', compact('data_pasien'));
    }
    public function jadwalMinumObat(){
        return view('pasien.jadwal-minum-obat');
    }
    public function laporanMinumObat(){
        return view('pasien.laporan-minum-obat');
    }
    public function riwayatMinumObat(){
        return view('pasien.riwayat-minum-obat-pasien');
    }
    public function daftarObat(){
        return view('pasien.daftar-obat');
    }
    public function detailObat(){
        return view('pasien.detail-obat');
    }
    public function aturJadwalObat(){
        return view('pasien.atur-jadwal-minum');
    }

    }


}
