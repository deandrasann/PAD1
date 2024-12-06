<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use App\Models\ResepModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengawasMinumObatController extends Controller
{
    public function pasienPMO(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')
                ->join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien') // Join dengan tabel resep
                ->whereNotNull('resep.id_pengawas') // Pastikan hanya pasien yang memiliki id_pengawas
                ->where(function ($query) use ($search) {
                    $query->orWhere('pasien.no_rm', $search)
                        ->orWhere('pasien.nama', 'like', "%" . $search . "%")
                        ->orWhere('pasien.alamat', 'like', "%" . $search . "%")
                        ->orWhere('pasien.tanggal_lahir', $search);
                })
                ->groupBy('pasien.id_pasien') // Group berdasarkan id_pasien untuk memastikan hanya 1 pasien yang ditampilkan
                ->select('pasien.*') // Ambil semua kolom pasien
                ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien') // Join dengan tabel resep
                ->whereNotNull('resep.id_pengawas') // Pastikan hanya pasien yang memiliki id_pengawas
                ->groupBy('pasien.id_pasien') // Group berdasarkan id_pasien untuk memastikan hanya 1 pasien yang ditampilkan
                ->select('pasien.*') // Ambil semua kolom pasien
                ->paginate(5);
        }
        return view('pmo.pmo-daftar-pasien', compact('data_pasien'));
    }

    public function cekpasienPMO($id)
    {
        $pasien = PasienModel::find($id);
        $no_resep = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
            ->where('pasien.id_pasien', $id)
            ->where('resep.status_resep', 'setuju')
            ->select('pasien.*', 'resep.*')
            ->first();
        $status_setuju_count = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
            ->where('pasien.id_pasien', $id) // Filter berdasarkan pasien
            ->where('resep.status_resep', 'setuju') // Filter hanya status_resep = 'setuju'
            ->count('resep.status_resep'); // Menghitung jumlah status_resep 'setuju'
        $data_pasien = DB::table('resep')
            ->join('detail_resep', 'resep.no_resep', '=', 'detail_resep.no_resep')
            ->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
            ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
            ->where('resep.id_pasien', $id)
            ->where('resep.status_resep', 'setuju')
            ->select('resep.*', 'detail_resep.*', 'obat.*', 'pasien.*', DB::raw('TIMESTAMPDIFF(YEAR, pasien.tanggal_lahir, CURDATE()) AS umur'))->get();
        return view('pmo.cek-pasien', compact('data_pasien', 'pasien', 'no_resep', 'status_setuju_count'));
    }

    public function pasienPMODestroy($id)
    {
        // Periksa apakah resep ada
        $resep = DB::table('resep')
            ->where('no_resep', $id)
            ->first();

        if ($resep) {
            // Mengupdate status_pengobatan menjadi 'Pengobatan Selesai'
            DB::table('resep')
                ->where('no_resep', $id)
                ->update(['status_pengobatan' => 'Pengobatan Selesai']);

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Status pengobatan berhasil diperbarui.');
        }

        // Jika tidak ditemukan, kembalikan error
        return redirect()->back()->with('error', 'Resep tidak ditemukan.');
    }

    public function riwayatMinumObat($id)
    {
        $pasien = PasienModel::find($id);
        return view('pmo.riwayat-minum-obat', compact('pasien'));
    }

    public function dataResepPMO($id)
    {
        $pasien = PasienModel::find($id);
        return view('pmo.data-resep-pmo', compact('pasien'));
    }

    public function cobacoba($id) {
         // Ambil semua resep yang ada
         $pasien = PasienModel::find($id);
         $data_pasien = ResepModel::where('id_pasien', $id)
         ->where('status_pengobatan', 'Proses Pengobatan')
         ->get();

         $data_jadwal = DB::table('resep')
         ->join('detail_resep', 'resep.no_resep', '=', 'detail_resep.no_resep')
         ->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
         ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
         ->where('resep.id_pasien', $id)
         ->where('resep.status_pengobatan', 'Proses Pengobatan')
         ->select('resep.*', 'detail_resep.*', 'obat.*','pasien.nama')->get();
        //  dd($data_jadwal);
         $jadwal = $data_pasien->pluck('jadwal_minum_obat')->unique();
         // Kirim data ke view
         return view('cobajadwalminumobat', compact('data_pasien', 'pasien', 'jadwal', 'data_jadwal'));
    }
}
