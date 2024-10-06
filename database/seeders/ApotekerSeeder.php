<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApotekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apoteker = collect([
            [
                'id_apoteker' => '1',
                'id_pengguna' => '3',
                'nama_apoteker' => 'apoteker1',
                'email' => 'apoteker@gmail.com',
                'foto' => 'ror1',
            ]
        ]);

        $apoteker->each(fn ($put) => DB::table('apoteker')->insert($put));
    }
}
