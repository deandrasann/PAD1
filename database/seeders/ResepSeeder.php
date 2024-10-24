<?php

namespace Database\Seeders;

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
                'id_admin' => '1',
                'id_pengguna' => '1',
                'id_klinik' => '1',
                'nama_admin' => 'adminpenjaga',
                'email' => 'admin@gmail.com',
                'foto' => 'ror',
            ]
        ]);

        $resep->each(fn ($put) => DB::table('resep')->insert($put));
    }
}
