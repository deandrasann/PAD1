<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResepsionisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resepsionis = collect([
            [
                'id_resepsionis' => '1',
                'id_pengguna' => '6',
                'nama_resepsionis' => 'resepsionis1',
                'email' => 'resepsionis@gmail.com',
            ],
        ]);

        $resepsionis->each(fn ($put) => DB::table('resepsionis')->insert($put));
    }
}
