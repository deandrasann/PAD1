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
                'no_antrian'   => 1,
                'id_dokter'    => 1,
                'id_pasien'    => 1,
                'id_pengawas'  => 1,
                'kode_obat'    => 1,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00, Malam: 19:00 - 21:00',
            ],
            [
                'no_antrian'   => 2,
                'id_dokter'    => 1,
                'id_pasien'    => 2,
                'id_pengawas'  => 1,
                'kode_obat'    => 2,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00',
            ],
            [
                'no_antrian'   => 3,
                'id_dokter'    => 1,
                'id_pasien'    => 3,
                'id_pengawas'  => 1,
                'kode_obat'    => 3,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'no_antrian'   => 4,
                'id_dokter'    => 1,
                'id_pasien'    => 4,
                'id_pengawas'  => 1,
                'kode_obat'    => 4,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00',
            ],
            [
                'no_antrian'   => 5,
                'id_dokter'    => 1,
                'id_pasien'    => 5,
                'id_pengawas'  => 1,
                'kode_obat'    => 5,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'no_antrian'   => 6,
                'id_dokter'    => 1,
                'id_pasien'    => 6,
                'id_pengawas'  => 1,
                'kode_obat'    => 6,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00, Malam: 19:00 - 21:00',
            ],
            [
                'no_antrian'   => 7,
                'id_dokter'    => 1,
                'id_pasien'    => 7,
                'id_pengawas'  => 1,
                'kode_obat'    => 7,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00, Siang: 13:00 - 15:00',
            ],
            [
                'no_antrian'   => 8,
                'id_dokter'    => 1,
                'id_pasien'    => 8,
                'id_pengawas'  => 1,
                'kode_obat'    => 8,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'no_antrian'   => 9,
                'id_dokter'    => 1,
                'id_pasien'    => 9,
                'id_pengawas'  => 1,
                'kode_obat'    => 9,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
            [
                'no_antrian'   => 10,
                'id_dokter'    => 1,
                'id_pasien'    => 10,
                'id_pengawas'  => 1,
                'kode_obat'    => 10,
                'tgl_resep'    => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'dosis'        => 5,
                'jadwal_minum_obat' => 'Pagi: 06:00 - 09:00',
            ],
        ]);

        $resep->each(fn ($put) => DB::table('resep')->insert($put));
    }
}
