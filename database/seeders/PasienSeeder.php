<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasien = collect([
            [
                'id_pasien' => '1',
                'no_rm' => '2312',
                'nama' => 'apoteker1',
                'alamat' => 'apoteker@gmail.com',
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '23-01-2005',
                'no_telp' => '0231412',
                'berat_badan' => '80kg'
            ]
        ]);

        $pasien->each(fn ($put) => DB::table('pasien')->insert($put));
    }
}
