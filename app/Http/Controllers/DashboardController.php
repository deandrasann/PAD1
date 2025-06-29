<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\PasienModel;
use App\Models\User;
use App\Models\ApotekerModel;
use App\Models\ObatModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function beranda()
    {
        $data = User::all();
        $data_pasien = DB::table('pasien')->count('id_pasien');
        $data_obat = DB::table('obat')->count('kode_obat');
        $data_apoteker = DB::table('apoteker')->count('id_apoteker');
        $data_pengawas = DB::table('pengawas')->count('id_pengawas');
        $data_dokter = DB::table('dokter')->count('id_dokter');
        $data_resepsionis = DB::table('resepsionis')->count('id_resepsionis');
        $data_pasien = DB::table('pasien')->count('id_pasien');
        $data_pasien_baru = DB::table('pasien')
            ->leftJoin('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')  // Join tabel pasien dengan resep berdasarkan id_pasien
            ->whereNull('resep.kode_obat')  // Memilih pasien yang tidak memiliki kode_obat (NULL)
            ->count();
        $pasienHariIni = DB::table('pasien')
            ->whereDate('created_at', Carbon::today())
            ->count();

        $totalPasien = DB::table('pasien')
            ->whereNull('deleted_at')
            ->count();

        //  Set default value supaya tidak error di compact()
        $totalPasienHariIni = 0;
        $pasienSelesai = 0;
        $pasienBelumDipanggil = 0;
        $idRole = Auth::user()->id_role; // atau sesuaikan dengan field role di user Anda

        if ($idRole == 'R02') { // Role 3 = Dokter (misalnya)
            $idPengguna = Auth::user()->id_pengguna;
            $today = Carbon::today()->toDateString();

            // Cek apakah user ini punya dokter
            $dokter = DB::table('dokter')->where('id_pengguna', $idPengguna)->first();
            if ($dokter) {
                $idDokter = $dokter->id_dokter;

                $totalPasienHariIni = DB::table('pemeriksaan_awal')
                    ->where('id_dokter', $idDokter)
                    ->whereDate('created_at', $today)
                    ->count();

                $pasienSelesai = DB::table('pemeriksaan_awal')
                    ->join('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
                    ->where('pemeriksaan_awal.id_dokter', $idDokter)
                    ->whereDate('pemeriksaan_awal.created_at', $today)
                    ->whereRaw("LOWER(pemeriksaan_akhir.status_pemeriksaan) = 'selesai'")
                    ->count();

                $pasienBelumDipanggil = DB::table('pemeriksaan_awal')
                    ->leftJoin('pemeriksaan_akhir', 'pemeriksaan_awal.id_pemeriksaan_awal', '=', 'pemeriksaan_akhir.id_pemeriksaan_awal')
                    ->where('pemeriksaan_awal.id_dokter', $idDokter)
                    ->whereRaw("LOWER(pemeriksaan_awal.status_pemanggilan) = 'belum dipanggil'")
                    ->where(function ($query) {
                        $query->whereNull('pemeriksaan_akhir.status_pemeriksaan')
                            ->orWhereRaw("LOWER(pemeriksaan_akhir.status_pemeriksaan) != 'selesai'");
                    })
                    ->count();
            }
        }

        return view('beranda', compact('data', 'data_pasien', 'data_obat', 'data_apoteker', 'data_pengawas','data_dokter', 'data_resepsionis', 'data_pasien', 'data_pasien_baru', 'pasienHariIni', 'totalPasien', 'totalPasienHariIni', 'pasienSelesai', 'pasienBelumDipanggil'));
    }

    public function pasienTerdaftar()
    {
        return view('pasien_terdaftar');
    }



    public function riwayatResep(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');

            $data_resep = DB::table('resep')
                ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
                ->select(
                    'pasien.id_pasien',
                    'pasien.nama',
                    'pasien.tanggal_lahir',
                    'pasien.alamat',
                    DB::raw('GROUP_CONCAT(DISTINCT resep.no_resep ORDER BY resep.no_resep ASC SEPARATOR ", ") as no_resep'),
                    DB::raw('GROUP_CONCAT(DISTINCT resep.tgl_resep ORDER BY resep.tgl_resep ASC SEPARATOR ", ") as tgl_resep'),
                    DB::raw('COUNT(resep.no_resep) as jumlah_obat')
                )
                ->where(function ($query) use ($search) {
                    $query->where('pasien.nama', 'like', '%' . $search . '%')
                        ->orWhere('pasien.alamat', 'like', '%' . $search . '%')
                        ->orWhere('resep.tgl_resep', 'like', '%' . $search . '%')
                        ->orWhere('resep.no_resep', 'like', '%' . $search . '%');
                })
                ->groupBy('pasien.id_pasien', 'pasien.nama', 'pasien.tanggal_lahir', 'pasien.alamat')
                ->paginate(5);
        } else {
            $data_resep = DB::table('resep')
                ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
                ->select(
                    'pasien.id_pasien',
                    'pasien.nama',
                    'pasien.tanggal_lahir',
                    'pasien.alamat',
                    DB::raw('GROUP_CONCAT(DISTINCT resep.no_resep ORDER BY resep.no_resep ASC SEPARATOR ", ") as no_resep'),
                    DB::raw('GROUP_CONCAT(DISTINCT resep.tgl_resep ORDER BY resep.tgl_resep ASC SEPARATOR ", ") as tgl_resep'),
                    DB::raw('COUNT(resep.no_resep) as jumlah_obat')
                )
                ->groupBy('pasien.id_pasien', 'pasien.nama', 'pasien.tanggal_lahir', 'pasien.alamat')
                ->paginate(5);
        }
        return view('riwayat-resep-obat', compact('data_resep'));
    }

    public function jumlahApoteker()
    {
        $data_apoteker = DB::table('users')->paginate(5);
        return view('admin.jumlah-apoteker', compact('data_apoteker'));
    }
    public function jumlahPengawas()
    {
        $data_pengawas = DB::table('users')->paginate(5);
        return view('admin.jumlah-pengawas', compact('data_pengawas'));
    }

    public function riwayatPasienPMO()
    {
        $data_pasien = DB::table('pasien')->paginate(5);
        return view('pmo.riwayat-pasien', compact('data_pasien'));
    }

    public function riwayatMinumObat2()
    {
        return view('pmo.riwayat-minum-obat2');
    }
    public function riwayatDataResep()
    {
        return view('pmo.riwayat-resep');
    }
}
