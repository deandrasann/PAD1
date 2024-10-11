<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokter = collect([
            [
                'id_dokter' => '1',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232131',
                'jenis_dokter' => 'dokterspesial',
                'spesialis' => 'spesial aja sih',
                'nama_dokter' => 'dokter1',
                'kode_bpjs' => '321321',
            ]
        ]);

        $dokter->each(fn ($put) => DB::table('dokter')->insert($put));
    }
}
