<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengawasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengawsas = collect([
            [
                'id_pengawas' => '1',
                'id_pengguna' => '4',
                'kode_klinik' => '1',
                'nama_pengawas' => 'pengawas1',
                'email' => 'pengawas@gmail.com',
            ]
        ]);

        $pengawsas->each(fn ($put) => DB::table('pengawas')->insert($put));
    }
}
