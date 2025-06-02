<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resep = collect([
            [
                'id_pemeriksaan_akhir'   => 1,
                'id_dokter'    => 1,
                'id_pasien'    => 1,
                'kode_obat'    => 1,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00, Malam: 19:00 - 21:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 2,
                'id_dokter'    => 1,
                'id_pasien'    => 2,
                'kode_obat'    => 2,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 3,
                'id_dokter'    => 1,
                'id_pasien'    => 3,
                'kode_obat'    => 3,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 4,
                'id_dokter'    => 1,
                'id_pasien'    => 4,
                'kode_obat'    => 4,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 5,
                'id_dokter'    => 1,
                'id_pasien'    => 5,
                'kode_obat'    => 5,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 6,
                'id_dokter'    => 1,
                'id_pasien'    => 6,
                'kode_obat'    => 6,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00, Malam: 19:00 - 21:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 7,
                'id_dokter'    => 1,
                'id_pasien'    => 7,
                'kode_obat'    => 7,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 8,
                'id_dokter'    => 1,
                'id_pasien'    => 8,
                'kode_obat'    => 8,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 9,
                'id_dokter'    => 1,
                'id_pasien'    => 9,
                'kode_obat'    => 9,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'id_pemeriksaan_akhir'   => 10,
                'id_dokter'    => 1,
                'id_pasien'    => 10,
                'kode_obat'    => 10,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
        ]);

        $resep->each(fn ($put) => DB::table('resep')->insert($put));
    }
}
