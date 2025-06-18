<?php

namespace App\Http\Controllers;

use App\Models\ObatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    public function obat(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data_obat = DB::table('obat')
                ->whereNull('deleted_at')
                ->where(function ($query) use ($search) {
                    $query->where('indikasi', 'like', '%' . $search . '%')
                        ->orWhere('golongan_obat', 'like', '%' . $search . '%')
                        ->orWhere('nama_obat', 'like', '%' . $search . '%');
                })
                ->paginate(5);
        } else {
            $data_obat = DB::table('obat')
                ->WhereNull('obat.deleted_at')
                ->paginate(5);
        }

        // $data = DB::table('obat')->paginate(5);
        $apoteker_obat = DB::table('apoteker')->get();
        return view('daftar_obat', compact('data_obat', 'apoteker_obat'));
    }

    public function obatstore(Request $request)
    {
        $validated = $request->validate([
            'id_apoteker' => 'required|integer',
            'nama_obat' => 'required|string',
            'bentuk_obat' => 'required|string',
            'kekuatan_sediaan' => 'required|numeric',
            'efek_samping' => 'required|string',
            'kontraindikasi' => 'required|string',
            'interaksi_obat' => 'required|string',
            'petunjuk_penyimpanan' => 'required|string',
            'pola_makan' => 'required|string',
            'informasi_tambahan' => 'required|string',
            'indikasi' => 'required|string',
            'golongan_obat' => 'required|string',
        ], [
            'required' => 'Field ini wajib diisi.',
            'integer' => 'Harus berupa angka bulat.',
            'numeric' => 'Harus berupa angka.',
            'string' => 'Harus berupa teks.',
        ]);

        $tambah_obat = ObatModel::insert([
            'id_apoteker' => $request->input('id_apoteker'),
            'nama_obat' => $request->input('nama_obat'),
            'bentuk_obat' => $request->input('bentuk_obat'),
            'kekuatan_sediaan' => $request->input('kekuatan_sediaan'),
            'efek_samping' => $request->input('efek_samping'),
            'kontraindikasi' => $request->input('kontraindikasi'),
            'interaksi_obat' => $request->input('interaksi_obat'),
            'petunjuk_penyimpanan' => $request->input('petunjuk_penyimpanan'),
            'pola_makan' => $request->input('pola_makan'),
            'informasi_tambahan' => $request->input('informasi_tambahan'),
            'indikasi' => $request->input('indikasi'),
            'golongan_obat' => $request->input('golongan_obat'),

        ]);
        return redirect()->route('daftar-obat')->with('success', 'berhasil menambahkan data');
    }

    public function obatupdate(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'bentuk_obat' => 'required|string|max:255',
            'kekuatan_sediaan' => 'required|integer|max:255',
            'efek_samping' => 'required|string',
            'kontraindikasi' => 'required|string',
            'indikasi' => 'required|string',
            'interaksi_obat' => 'required|string',
            'petunjuk_penyimpanan' => 'required|string',
            'golongan_obat' => 'required|string|max:255',
            'pola_makan' => 'required|string',
            'informasi_tambahan' => 'nullable|string',
            'status_ketersediaan_obat' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        // Update data
        $data_obat = ObatModel::find($id);
        $upd = ObatModel::where('kode_obat', '=', $data_obat->kode_obat)->update($validated);

        return redirect()->route('daftar-obat')->with('success', 'Berhasil mengubah data');
    }


    public function obatdestroy($id)
    {
        $delete_obat = ObatModel::where('kode_obat', $id)->delete();

        if ($delete_obat) {
            return back()->with('success', 'Data obat berhasil dihapus.');
        } else {
            return back()->with('error', 'Gagal menghapus data obat.');
        }
    }
}
