<?php

namespace App\Http\Controllers;

use App\Models\ApotekerModel;
use App\Models\DetailResepModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\ResepModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ResepController extends Controller
{
    public function resepTiapPasien(Request $request, $id)
    {
        // $itemid = $request->input('kode_obat');
        // // dd($request->all());

        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('resep')->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
                ->where('resep.id_pasien', $id)
                ->where('resep.status_resep', 'setuju')
                ->where(function ($query) use ($search) {  // Gunakan closure untuk kondisi pencarian
                    $query->orWhere('indikasi', 'like', "%" . $search . "%")
                        ->orWhere('golongan_obat', 'like', "%" . $search . "%")
                        ->orWhere('nama_obat', 'like', "%" . $search . "%");
                })
                ->paginate(5);
        } else {
            $data = DB::table('resep')->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
                ->where('resep.id_pasien', $id)
                ->where('resep.status_resep', 'setuju')
                ->paginate(5);
        }

        // $data2 = DB::table('obat')->where('kode_obat', $itemid)->first();

        $kode_obat = $request->input('kode_obat');
        $obat = DB::table('obat')->where('kode_obat', $kode_obat)->first();

        $pasien = PasienModel::where('id_pasien', $id)->first();

        // $data = DB::table('obat')->where('id_pasien', $id)->paginate(5);
        $data_dokter = DB::table('dokter')->get();
        $data_obat = DB::table('obat')
        ->where('status_ketersediaan_obat', 'stocked') // Menyaring berdasarkan status_ketersediaan_obat 'stocked'
        ->get();;
        // $data_pemeriksaan = DB::table('pemeriksaan')
        // ->join('pasien', 'pemeriksaan.id_pasien', '=', 'pasien.id_pasien')  // Join dengan tabel pasien
        // ->join('dokter', 'pemeriksaan.nama_dokter', '=', 'dokter.id_dokter')  // Join dengan tabel dokter
        // ->where('pasien.id_pasien', $id)  // Filter berdasarkan id_pasien
        // ->select('pemeriksaan.no_antrian', 'pemeriksaan.tgl_diagnosa', 'pasien.nama as nama_pasien', 'pasien.alamat', 'dokter.nama_dokter as nama_dokter', 'dokter.id_dokter')  // Pilih kolom yang dibutuhkan
        // ->get();
         $data_pemeriksaan = DB::table('pemeriksaan_akhir')
        ->join('pasien', 'pemeriksaan_akhir.id_pasien', '=', 'pasien.id_pasien')  // Join dengan tabel pasien
        ->join('dokter', 'pemeriksaan_akhir.id_dokter', '=', 'dokter.id_dokter')  // Join dengan tabel dokter
        ->where('pasien.id_pasien', $id)  // Filter berdasarkan id_pasien
        ->select('pemeriksaan_akhir.id_pemeriksaan_akhir', 'pasien.nama as nama_pasien', 'pasien.alamat', 'dokter.nama_dokter as nama_dokter', 'dokter.id_dokter')  // Pilih kolom yang dibutuhkan
        ->get();

        $data_pengawas = DB::table('pengawas')->get();
        // ApotekerModel::join('obat', 'apoteker.id_apoteker', '=', 'obat.id_apoteker')
        //         ->select('obat.*', 'apotekerr.id_apoteker', 'apoteker.nama_apoteker')
        //         ->distinct()
        //         ->get();
        $resep_obat = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
            ->where('pasien.id_pasien', $id)
            ->select('pasien.*', 'resep.*')
            ->first();
        // dd($data_dokter);
        dd($resep_obat);
        // $resep_obat1 = DB::table('resep')->get();
        return view('resep-tiap-pasien', compact('data', 'pasien', 'obat', 'resep_obat', 'data_dokter', 'data_obat', 'data_pemeriksaan','data_pengawas', 'id'));
    }
    public function tambahResep(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')->orWhere('no_rm', $search)
                ->WhereNull('pasien.deleted_at')
                ->orWhere('nama', 'like', "%" . $search . "%")
                ->orWhere('alamat', 'like', "%" . $search . "%")
                ->orWhere('tanggal_lahir', $search)
                ->orderBy('nama', 'asc')
                ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
                ->WhereNull('pasien.deleted_at')
                ->orderBy('nama', 'asc')
                ->paginate(5);
        }
        return view('pasien-resep', compact('data_pasien'));
    }

    public function TambahPasien(Request $request) {
        $tambah_pasien = PasienModel::insert([
            'no_rm' => $request->input('no_rm'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'berat_badan' => $request->input('berat_badan'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
        ]);
        return redirect()->route('tambah-resep')->with('success', 'Berhasil Menambahkan Pasien');
    }

    public function getDosis(Request $request)
    {
        $kode_obat = $request->kode_obat;

        $obat = ObatModel::where('kode_obat', $kode_obat)->first();

        if (!$obat) {
            return response()->json(['dosis_options' => []]);
        }

        $max_dosis = $obat->kekuatan_sediaan;

        $dosis_options = [];
        for ($i = 1; $i <= $max_dosis; $i++) {
            $dosis_options[] = $i;
        }

        return response()->json(['dosis_options' => $dosis_options]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction(); // Memulai transaksi database
        $apoteker = ApotekerModel::where('id_pengguna', Auth::id())->first();
        try {
            // Data untuk tabel Resep
            $tambah_resep = [
                'id_pemeriksaan_akhir' => $request->input('id_pemeriksaan_akhir'),
                'id_pasien' => $request->input('id_pasien'),
                'id_apoteker' => $apoteker->id_apoteker, // Menggunakan id_apoteker dari model Apoteker
                'kode_obat' => $request->input('kode_obat'),
                'tgl_resep' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis' => $request->input('dosis'),
            ];

            // dd($tambah_resep);
            // dd($tambah_resep);
            // Simpan data ke tabel Resep
            $resep = ResepModel::create($tambah_resep);

            // Setelah menyimpan resep, kita akan mengurangi nilai kekuatan_sediaan di tabel obat
            $kode_obat = $request->input('kode_obat');
            $dosis = $request->input('dosis');

            // Ambil data obat berdasarkan kode_obat yang dimasukkan
            $obat = ObatModel::where('kode_obat', $kode_obat)->first();

            // Periksa apakah obat ditemukan
            if (!$obat) {
                // Jika obat tidak ditemukan, rollback transaksi dan kembalikan error
                DB::rollback();
                return redirect()->back()->with('error', 'Obat tidak ditemukan!');
            }

            // Kurangi kekuatan_sediaan dengan dosis yang dimasukkan
            $new_kekuatan_sediaan = $obat->kekuatan_sediaan - $dosis;

            // Pastikan kekuatan_sediaan tidak menjadi negatif
            if ($new_kekuatan_sediaan < 0) {
                // Jika dosis melebihi kekuatan_sediaan yang ada, rollback transaksi dan beri pesan error
                DB::rollback();
                return redirect()->back()->with('error', 'Dosis melebihi kekuatan sediaan obat!');
            }

            if ($new_kekuatan_sediaan == 0) {
                $obat->update(['status_ketersediaan_obat' => 'Habis']);
            }

            // Update nilai kekuatan_sediaan
            $obat->update(['kekuatan_sediaan' => $new_kekuatan_sediaan]);

            // Hitung jumlah resep yang telah disetujui untuk pasien
            $jumlah_resep = DB::table('resep')
                ->where('id_pasien', $request->input('id_pasien')) // Menggunakan id_pasien
                ->where('status_resep', 'setuju') // Kondisi status_resep 'setuju'
                ->count(); // Hitung jumlah resep yang memiliki status 'setuju'

            // Data untuk tabel Detail Resep
            $tambah_detail = [
                'no_resep' => $resep->no_resep, // Menggunakan ID yang baru dibuat dari tabel Resep
                'jumlah_resep' => $jumlah_resep,
            ];

            // Simpan data ke tabel DetailResep
            DetailResepModel::create($tambah_detail);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            // Redirect ke halaman resep pasien
            $idpasien = $request->id_pasien;
            return redirect()->route('resep-tiap-pasien', ['id' => $idpasien])->with('success', 'Resep berhasil ditambahkan.');

        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback perubahan
            DB::rollback();

            $errorMessage = $e->getMessage();

            $idpasien = $request->id_pasien;
            return redirect()->route('resep-tiap-pasien', ['id' => $idpasien])->with('error', 'Gagal menambahkan Resep:' . $errorMessage);
        }
    }



    public function destroy($id)
    {
        DB::beginTransaction();

    try {
        // Ambil data resep yang terkait dengan no_resep
        $resep = ResepModel::where('no_resep', $id)->first();

        // Pastikan status resep adalah 'setuju' sebelum melanjutkan (Jika perlu)
        if ($resep && $resep->status_resep !== 'deleted') {
            // Update status_resep menjadi 'deleted' di tabel resep
            $updateResep = ResepModel::where('no_resep', $id)->update(['status_resep' => 'deleted']);

            if ($updateResep) {
                // Ambil jumlah_resep yang terkait dengan no_resep di tabel detail_resep
                $detailResep = DB::table('detail_resep')
                    ->where('no_resep', $id)
                    ->first();

                if ($detailResep) {
                    // Kurangi jumlah_resep sebanyak 1 (jika lebih dari 0)
                    $newJumlahResep = $detailResep->jumlah_resep - 1;

                    // Update jumlah_resep dengan nilai baru (kurangi 1)
                    DB::table('detail_resep')
                        ->where('no_resep', $id)
                        ->update(['jumlah_resep' => $newJumlahResep]);
                }

                // Commit transaksi
                DB::commit();

                return back()->with('success', 'Resep berhasil dihapus dan detail resep diperbarui.');
            }
        }

        return back()->with('error', 'Resep tidak ditemukan atau statusnya sudah diubah.');

    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi error
        DB::rollBack();
        return back()->with('error', 'Gagal memperbarui resep.');
    }
    }

    public function detailDataObat($id)
    {
        $data_detail_obat = DB::table('resep')
        ->join('detail_resep', 'resep.no_resep', '=', 'detail_resep.no_resep')
        ->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat')
        ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
        ->where('resep.id_pasien', $id)
        ->where('resep.status_resep', 'setuju')
        ->select('resep.*', 'detail_resep.*', 'obat.*','pasien.nama', 'pasien.jenis_kelamin', DB::raw('TIMESTAMPDIFF(YEAR, pasien.tanggal_lahir, CURDATE()) AS umur'))->get();


        $url = url('cek-pasien/' . $id);
        

        // Generate QR Code
        $qrCode = QrCode::size(200)->generate($url);

        // dd($data_detail_obat);
        return view('detail-data-obat', compact('data_detail_obat', 'qrCode'));
    }
}
