<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\obatNonRacikanModel;
use App\Models\obatRacikanModel;
use App\Models\PasienModel;
use App\Models\ResepModel;
use App\Models\ResepObatModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ResepApiController extends Controller
{
    public function getResep(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');

            $data_resep = DB::table('resep')
                ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
                ->leftJoin('resep_obat', 'resep.no_resep', '=', 'resep_obat.no_resep')
                ->select(
                    'pasien.id_pasien',
                    'pasien.nama',
                    'pasien.tanggal_lahir',
                    'pasien.alamat',
                    DB::raw('GROUP_CONCAT(DISTINCT resep.no_resep ORDER BY resep.no_resep ASC SEPARATOR ", ") as no_resep'),
                    DB::raw('GROUP_CONCAT(DISTINCT resep.tgl_resep ORDER BY resep.tgl_resep ASC SEPARATOR ", ") as tgl_resep'),
                    DB::raw('COUNT(resep_obat.no_resep) as jumlah_obat') 
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
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data obat.',
            'data' => $data_resep
        ], 200);
    }

    public function getResepPasien(Request $request, $id)
    {
        // Ambil data pasien
        $data_pasien = PasienModel::where('id_pasien', $id)->first();

        if (!$data_pasien) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pasien tidak ditemukan.'
            ], 404);
        }

        // Ambil data resep utama
        $data_resep = ResepModel::where('id_pasien', $id)->latest()->first();

        $searchTerm = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $page = $request->query('page', 1);

        // --- Logika Pencarian untuk Obat Racikan ---
        $racikanQuery = obatRacikanModel::where('id_pasien', $id);
        if ($searchTerm) {
            $racikanQuery->where(function ($query) use ($searchTerm) {
                $query->where('nama_racikan', 'like', '%' . $searchTerm . '%')
                      ->orWhere('bentuk_obat', 'like', '%' . $searchTerm . '%');
            });
        }
        // Ambil data, map ke array, lalu ubah menjadi Illuminate\Support\Collection
        $obatRacikan = $racikanQuery->get()->map(function($item) {
            return [
                'tipe_obat' => 'racikan',
                'detail_obat' => $item->toArray(),
            ];
        })->values(); // Penting: Reset keys jika ada yang kosong
        // Konversi eksplisit menjadi Illuminate\Support\Collection biasa
        $obatRacikan = collect($obatRacikan->all()); // Mengambil semua item sebagai array lalu membuat Collection baru

        // --- Logika Pencarian untuk Obat Non-Racikan ---
        $nonRacikanQuery = obatNonRacikanModel::where('obat_non_racikan.id_pasien', $id)
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
        if ($searchTerm) {
            $nonRacikanQuery->where(function ($query) use ($searchTerm) {
                $query->where('obat.nama_obat', 'like', '%' . $searchTerm . '%')
                      ->orWhere('obat_non_racikan.bentuk_obat', 'like', '%' . $searchTerm . '%')
                      ->orWhere('obat_non_racikan.signatura', 'like', '%' . $searchTerm . '%');
            });
        }
        // Ambil data, map ke array, lalu ubah menjadi Illuminate\Support\Collection
        $obatNonRacikan = $nonRacikanQuery->get()->map(function($item) {
            return [
                'tipe_obat' => 'non_racikan',
                'detail_obat' => $item->toArray(),
            ];
        })->values(); // Penting: Reset keys jika ada yang kosong
        // Konversi eksplisit menjadi Illuminate\Support\Collection biasa
        $obatNonRacikan = collect($obatNonRacikan->all()); // Mengambil semua item sebagai array lalu membuat Collection baru


        // --- Menggabungkan dan Melakukan Paginasi secara Manual (Collection Paginator) ---
        // Kedua collection sekarang adalah Illuminate\Support\Collection yang hanya berisi array
        $combinedObat = $obatRacikan->merge($obatNonRacikan)->sortBy(function($item) {
            return $item['detail_obat']['created_at'] ?? '0';
        })->values();

        // Manual Paginasi pada Collection
        $total = $combinedObat->count();
        $offset = ($page - 1) * $perPage;
        $itemsForCurrentPage = $combinedObat->slice($offset, $perPage)->values();

        // Buat LengthAwarePaginator secara manual
        $paginatedObat = new LengthAwarePaginator(
            $itemsForCurrentPage,
            $total,
            $perPage,
            $page,
            ['path' => url($request->url(), ['id' => $id])]
        );

        // Data pemeriksaan
        $data_pemeriksaan = DB::table('pemeriksaan_akhir')
            ->join('pasien', 'pemeriksaan_akhir.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan_akhir.id_dokter', '=', 'dokter.id_dokter')
            ->where('pasien.id_pasien', $id)
            ->select('pemeriksaan_akhir.id_pemeriksaan_akhir', 'pasien.nama as nama_pasien', 'pasien.alamat', 'dokter.nama_dokter as nama_dokter', 'dokter.id_dokter')
            ->get();


        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data obat.',
            'data' => [
                'data_resep' => $data_resep ? $data_resep->toArray() : null,
                'dataObatResep' => $paginatedObat->items(),
                'links' => $paginatedObat->linkCollection()->toArray(),
                'meta' => [
                    'current_page' => $paginatedObat->currentPage(),
                    'from' => $paginatedObat->firstItem(),
                    'last_page' => $paginatedObat->lastPage(),
                    'per_page' => $paginatedObat->perPage(),
                    'to' => $paginatedObat->lastItem(),
                    'total' => $paginatedObat->total(),
                ],
                'data_pasien' => $data_pasien->toArray(),
                'data_pemeriksaan' => $data_pemeriksaan->toArray()
            ]
        ], 200);
    }

    public function editStatusPenyerahan(Request $request, $id)
    {
        $request->validate([
            'status_diserahkan' => ['required', 'string', 'in:diserahkan,belum_diserahkan'],
        ]);

        try {
            // Cari resep berdasarkan id_pasien
            $resep = ResepModel::where('id_pasien', $id)->latest()->first();

            if (!$resep) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Resep tidak ditemukan untuk pasien ini.'
                ], 404);
            }

            // Update status_diserahkan
            $resep->status_diserahkan = $request->status_diserahkan;
            $resep->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status penyerahan resep berhasil diperbarui.',
                'data' => $resep // Mengembalikan data resep yang sudah diupdate
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui status penyerahan resep: ' . $e->getMessage()
            ], 500);
        }
    }
}
