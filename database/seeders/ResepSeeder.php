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
                'kode_obat'    => 1,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '100000',
            ],
            [
                'no_antrian'   => 2,
                'id_dokter'    => 1,
                'id_pasien'    => 2,
                'kode_obat'    => 2,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '150000',
            ],
            [
                'no_antrian'   => 3,
                'id_dokter'    => 1,
                'id_pasien'    => 3,
                'kode_obat'    => 3,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '200000',
            ],
            [
                'no_antrian'   => 4,
                'id_dokter'    => 1,
                'id_pasien'    => 4,
                'kode_obat'    => 4,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '250000',
            ],
            [
                'no_antrian'   => 5,
                'id_dokter'    => 1,
                'id_pasien'    => 5,
                'kode_obat'    => 5,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '120000',
            ],
            [
                'no_antrian'   => 6,
                'id_dokter'    => 1,
                'id_pasien'    => 6,
                'kode_obat'    => 6,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '300000',
            ],
            [
                'no_antrian'   => 7,
                'id_dokter'    => 1,
                'id_pasien'    => 7,
                'kode_obat'    => 7,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '400000',
            ],
            [
                'no_antrian'   => 8,
                'id_dokter'    => 1,
                'id_pasien'    => 8,
                'kode_obat'    => 8,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '350000',
            ],
            [
                'no_antrian'   => 9,
                'id_dokter'    => 1,
                'id_pasien'    => 9,
                'kode_obat'    => 9,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '220000',
            ],
            [
                'no_antrian'   => 10,
                'id_dokter'    => 1,
                'id_pasien'    => 10,
                'kode_obat'    => 10,
                'tgl_resep'    => Carbon::now()->toDateString(),
                'total_harga'  => '180000',
            ]
        ]);

        $resep->each(fn ($put) => DB::table('resep')->insert($put));
    }
}
