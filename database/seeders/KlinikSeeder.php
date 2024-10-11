<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klinik = collect([
            [
                'id_klinik' => '1',
                'kode_klinik' => 'KLK1',
                'kode_bpjs' => '2134124',
                'nama_klinik' => 'klinikdummy'
            ],
        ]);
        $klinik->each(fn ($put) => DB::table('klinik')->insert($put));
    }
}
