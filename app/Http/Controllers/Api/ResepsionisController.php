<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepsionisController extends Controller
{

    public function apiGetPasien(Request $request)
    {
        $query = DB::table('pasien')
            ->whereNull('deleted_at');

        // Jika ada parameter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('no_rm', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('jenis_kelamin', 'like', '%' . $search . '%')
                    ->orWhere('no_telp', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_lahir', 'like', '%' . $search . '%');
            });
        }

        // Paginasi (default 5 per halaman, bisa diubah via parameter)
        $perPage = $request->input('per_page', 5);
        $data_pasien = $query->orderBy('nama', 'asc')->paginate($perPage);

        // Kembalikan dalam bentuk JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Data pasien berhasil diambil',
            'data' => $data_pasien
        ]);
    }

    public function apiGetPasienByNoRM($no_rm = null)
    {
        if ($no_rm) {
            $pasien = DB::table('pasien')->where('no_rm', $no_rm)->first();

            if ($pasien) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data pasien ditemukan.',
                    'data' => $pasien
                ], 200);
            } else {
                return response()->json([
                    'status' => 'not_found',
                    'message' => 'Data pasien tidak ditemukan.',
                    'data' => null
                ], 404);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Parameter no_rm dibutuhkan.',
        ], 400);
    }

    public function apiStorePasien(Request $request)
    {
        // Validasi menggunakan request()->validate()
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'nama_provinsi' => 'required|string|max:255',
            'nama_kabupaten' => 'required|string|max:255',
            'nama_kecamatan' => 'required|string|max:255',
            'nama_kelurahan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        // Generate no_rm baru yang unik
        do {
            $lastNoRM = DB::table('pasien')
                ->orderBy('id_pasien', 'desc')
                ->value('no_rm');

            if ($lastNoRM && preg_match('/RM(\d+)/', $lastNoRM, $matches)) {
                $lastNumber = (int) $matches[1];
            } else {
                $lastNumber = 0;
            }

            $newNumber = $lastNumber + 1;
            $newNoRM = 'RM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            $exists = DB::table('pasien')->where('no_rm', $newNoRM)->exists();
        } while ($exists);

        // Simpan data pasien
        $id_pasien = DB::table('pasien')->insertGetId([
            'no_rm' => $newNoRM,
            'id_pengguna' => 1,
            'nama' => $validated['nama'],
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_telp' => $validated['no_telp'] ?? null,
            'email' => $validated['email'] ?? null,
            'provinsi' => $validated['nama_provinsi'],
            'kabupaten' => $validated['nama_kabupaten'],
            'kecamatan' => $validated['nama_kecamatan'],
            'kelurahan' => $validated['nama_kelurahan'],
            'alamat' => $validated['alamat'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pasien berhasil disimpan.',
            'data' => [
                'id_pasien' => $id_pasien,
                'no_rm' => $newNoRM
            ]
        ], 201);
    }

    public function apiTambahDataKesehatanPasien($id)
    {
        $pasien = DB::table('pasien')->where('id_pasien', $id)->first();

        if (!$pasien) {
            return response()->json([
                'message' => 'Pasien tidak ditemukan.'
            ], 404);
        }

        $dokters = DB::table('dokter')->get();

        return response()->json([
            'message' => 'Data berhasil diambil.',
            'data' => [
                'pasien' => $pasien,
                'dokters' => $dokters
            ]
        ], 200);
    }

    public function storeDataKesehatanApi($id, Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'merokok' => 'required|in:ya,tidak',
            'berat_badan' => 'required|numeric|min:1',
            'tinggi_badan' => 'required|numeric|min:1',
            'hamil_menyusui' => 'nullable|in:hamil,menyusui,Tidak Keduanya',
            'keluhan_awal' => 'nullable|string',
            'alergi_obat' => 'nullable|string',
            'suhu_tubuh' => 'required|numeric',
            'nadi' => 'required|integer',
            'sistole' => 'required|integer',
            'diastole' => 'required|integer',
            'pernapasan' => 'required|integer',
        ]);



        // Simpan ke database
        DB::table('pemeriksaan_awal')->insert([
            'id_pasien' => $id,
            'id_dokter' => $validated['id_dokter'],
            'tanggal_pemeriksaan' => now(),
            'golongan_darah' => $validated['golongan_darah'],
            'merokok' => $validated['merokok'],
            'berat_badan' => $validated['berat_badan'],
            'tinggi_badan' => $validated['tinggi_badan'],
            'hamil_menyusui' => $validated['hamil_menyusui'] ?? null,
            'keluhan_awal' => $validated['keluhan_awal'] ?? null,
            'ket_alergi_obat' => $validated['alergi_obat'] ?? null,
            'suhu_tubuh' => $validated['suhu_tubuh'],
            'nadi' => $validated['nadi'],
            'sistole' => $validated['sistole'],
            'diastole' => $validated['diastole'],
            'pernapasan' => $validated['pernapasan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Data kesehatan berhasil disimpan.'
        ], 201);
    }
}
