<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApotekerModel;
use App\Models\ObatModel;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatApiController extends Controller
{
    public function getObat(Request $request)
    {
        // Selalu mulai dengan query dasar yang hanya mengambil data yang belum di-soft delete
        $query = DB::table('obat')->whereNull('obat.deleted_at');

        // Mengecek apakah ada parameter 'search' pada request
        if ($request->has('search')) {
            $search = $request->input('search');

            // Gunakan where() dengan closure untuk mengelompokkan kondisi OR
            // Ini akan menjadi: WHERE deleted_at IS NULL AND (indikasi LIKE %...% OR golongan_obat LIKE %...% OR nama_obat LIKE %...%)
            $query->where(function($q) use ($search) {
                $q->where('indikasi', 'like', "%" . $search . "%")
                  ->orWhere('golongan_obat', 'like', "%" . $search . "%")
                  ->orWhere('nama_obat', 'like', "%" . $search . "%");
            });
        }

        // Terapkan paginasi pada query yang sudah dibangun
        $data_obat = $query->paginate(5);

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data obat.',
            'data' => $data_obat
        ], 200);
    }
    public function createObat(Request $request)
    {
        // Validasi input data obat
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'takaran_minum' => 'nullable|string|max:255',
            'jml_kali_minum' => 'nullable|integer',
            'jml_obat_per_minum' => 'nullable|integer',
            'bentuk_obat' => 'nullable|string|max:255',
            'kemasan_obat' => 'nullable|string|max:255',
            'aturan_pakai' => 'nullable|string|max:255',
            'golongan_obat' => 'required|string|max:255',
            'jumlah_obat' => 'nullable|string',
            'waktu_minum' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'harga_satuan' => 'nullable|numeric',
            'kontraindikasi' => 'nullable|string|max:255',
            'pola_makan' => 'nullable|string|max:255',
            'interaksi_obat' => 'nullable|string|max:255',
            'petunjuk_penyimpanan' => 'nullable|string|max:255',
            'kekuatan_sediaan' => 'required|string|max:255',
            'informasi_tambahan' => 'nullable|string|max:255',
            'efek_samping' => 'nullable|string|max:255',
            'indikasi' => 'required|string|max:255',
            'status_ketersediaan_obat' => 'required|in:Stocked,Draft,Habis',
        ]);

        DB::beginTransaction(); // Memulai transaksi database

        $apoteker = ApotekerModel::where('id_pengguna', Auth::id())->first();

        try {
            // Membuat data obat baru
            $obat = ObatModel::create([
                'id_apoteker' => $apoteker->id_apoteker,
                'id_pasien' => $apoteker->id_apoteker,
                'nama_obat' => $request->nama_obat,
                'takaran_minum' => $request->takaran_minum,
                'jml_kali_minum' => $request->jml_kali_minum,
                'jml_obat_per_minum' => $request->jml_obat_per_minum,
                'bentuk_obat' => $request->bentuk_obat,
                'kemasan_obat' => $request->kemasan_obat,
                'aturan_pakai' => $request->aturan_pakai,
                'golongan_obat' => $request->golongan_obat,
                'jumlah_obat' => $request->jumlah_obat,
                'waktu_minum' => $request->waktu_minum,
                'keterangan' => $request->keterangan,
                'harga_satuan' => $request->harga_satuan,
                'kontraindikasi' => $request->kontraindikasi,
                'pola_makan' => $request->pola_makan,
                'interaksi_obat' => $request->interaksi_obat,
                'petunjuk_penyimpanan' => $request->petunjuk_penyimpanan,
                'kekuatan_sediaan' => $request->kekuatan_sediaan,
                'informasi_tambahan' => $request->informasi_tambahan,
                'efek_samping' => $request->efek_samping,
                'indikasi' => $request->indikasi,
                'status_ketersediaan_obat' => $request->status_ketersediaan_obat,
            ]);

            DB::commit(); // Jika operasi berhasil, commit transaksi

            return response()->json([
                'status' => 'success',
                'message' => 'Data obat berhasil ditambahkan.',
                'data' => $obat
            ], 201); // 201 Created
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback transaksi

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data obat.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Memperbarui data obat yang sudah ada.
     * Mengikuti gaya penanganan transaksi dan validasi seperti updateDokter.
     */
    public function updateObat(Request $request, $kode_obat)
    {
        // Temukan obat berdasarkan kode_obat
        $obat = ObatModel::where('kode_obat', $kode_obat)->first();

        // Jika obat tidak ditemukan
        if (!$obat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Obat tidak ditemukan.'
            ], 404); // 404 Not Found
        }

        // Validasi input data obat
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'takaran_minum' => 'nullable|string|max:255',
            'jml_kali_minum' => 'nullable|integer',
            'jml_obat_per_minum' => 'nullable|integer',
            'bentuk_obat' => 'nullable|string|max:255',
            'kemasan_obat' => 'nullable|string|max:255',
            'aturan_pakai' => 'nullable|string|max:255',
            'golongan_obat' => 'required|string|max:255',
            'jumlah_obat' => 'nullable|string',
            'waktu_minum' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'harga_satuan' => 'nullable|numeric',
            'kontraindikasi' => 'nullable|string|max:255',
            'pola_makan' => 'nullable|string|max:255',
            'interaksi_obat' => 'nullable|string|max:255',
            'petunjuk_penyimpanan' => 'nullable|string|max:255',
            'kekuatan_sediaan' => 'required|string|max:255',
            'informasi_tambahan' => 'nullable|string|max:255',
            'efek_samping' => 'nullable|string|max:255',
            'indikasi' => 'required|string|max:255',
            'status_ketersediaan_obat' => 'required|in:Stocked,Draft,Habis',
        ]);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Memperbarui data obat
            $obat->update([
                'nama_obat' => $request->nama_obat,
                'takaran_minum' => $request->takaran_minum,
                'jml_kali_minum' => $request->jml_kali_minum,
                'jml_obat_per_minum' => $request->jml_obat_per_minum,
                'bentuk_obat' => $request->bentuk_obat,
                'kemasan_obat' => $request->kemasan_obat,
                'aturan_pakai' => $request->aturan_pakai,
                'golongan_obat' => $request->golongan_obat,
                'jumlah_obat' => $request->jumlah_obat,
                'waktu_minum' => $request->waktu_minum,
                'keterangan' => $request->keterangan,
                'harga_satuan' => $request->harga_satuan,
                'kontraindikasi' => $request->kontraindikasi,
                'pola_makan' => $request->pola_makan,
                'interaksi_obat' => $request->interaksi_obat,
                'petunjuk_penyimpanan' => $request->petunjuk_penyimpanan,
                'kekuatan_sediaan' => $request->kekuatan_sediaan,
                'informasi_tambahan' => $request->informasi_tambahan,
                'efek_samping' => $request->efek_samping,
                'indikasi' => $request->indikasi,
                'status_ketersediaan_obat' => $request->status_ketersediaan_obat,
            ]);

            DB::commit(); // Jika operasi berhasil, commit transaksi

            return response()->json([
                'status' => 'success',
                'message' => 'Data obat berhasil diperbarui.',
                'data' => $obat
            ], 200); // 200 OK
        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi kesalahan, rollback transaksi

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui data obat.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Melakukan soft delete pada data obat.
     * Mengikuti gaya penanganan error seperti deleteDokter.
     */
    public function destroyObat($kode_obat)
    {
        try {
            // Temukan obat berdasarkan kode_obat dan lakukan soft delete
            // Pastikan ObatModel menggunakan trait SoftDeletes
            $obat = ObatModel::where('kode_obat', $kode_obat)->first();

            if (!$obat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Obat tidak ditemukan.'
                ], 404); // 404 Not Found
            }

            $delete_obat = $obat->delete(); // Ini akan mengatur `deleted_at`

            if ($delete_obat) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Obat berhasil dihapus (soft deleted).'
                ], 200); // 200 OK
            } else {
                // Ini mungkin tidak akan tercapai jika delete() sukses,
                // tapi baik untuk penanganan error umum.
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus obat.'
                ], 500); // 500 Internal Server Error
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus obat.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }
}
