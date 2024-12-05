<?php

namespace App\Http\Controllers;

use App\Models\DetailResepModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\ResepModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $data = DB::table('obat')->where('id_pasien', $id)->paginate(5);
        $data_dokter = DB::table('dokter')->get();
        $data_obat = DB::table('obat')->get();
        $data_pemeriksaan = DB::table('pemeriksaan')->get();
        $data_pengawas = DB::table('pengawas')->get();
        // ApotekerModel::join('obat', 'apoteker.id_apoteker', '=', 'obat.id_apoteker')
        //         ->select('obat.*', 'apoteker.id_apoteker', 'apoteker.nama_apoteker')
        //         ->distinct()
        //         ->get();
        $resep_obat = PasienModel::join('resep', 'pasien.id_pasien', '=', 'resep.id_pasien')
            ->where('pasien.id_pasien', $id)
            ->select('pasien.*', 'resep.*')
            ->first();
        // dd($data_dokter);
        // $resep_obat1 = DB::table('resep')->get();
        return view('resep-tiap-pasien', compact('data', 'obat', 'resep_obat', 'data_dokter', 'data_obat', 'data_pemeriksaan','data_pengawas'));
    }
    public function tambahResep(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_pasien = DB::table('pasien')->orWhere('no_rm', $search)
                ->orWhere('nama', 'like', "%" . $search . "%")
                ->orWhere('alamat', 'like', "%" . $search . "%")
                ->orWhere('tanggal_lahir', $search)
                ->paginate(5);
        } else {
            $data_pasien = DB::table('pasien')
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

    public function store(Request $request)
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            // Data untuk tabel Resep
            $tambah_resep = [
                'no_antrian' => $request->input('no_antrian'),
                'id_pasien' => $request->input('id_pasien'),
                'id_dokter' => $request->input('id_dokter'),
                'id_pengawas' => $request->input('id_pengawas'),
                'kode_obat' => $request->input('kode_obat'),
                'tgl_resep' => NOW(),
                'dosis' => $request->input('dosis'),
            ];
    
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
            $idpasien = $request->id_pasien;
            return redirect()->route('resep-tiap-pasien', ['id' => $idpasien])->with('error', 'Gagal menambahkan Resep: ' . $e->getMessage());
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
        // dd($data_detail_obat);
        return view('detail-data-obat', compact('data_detail_obat'));
    }
}
