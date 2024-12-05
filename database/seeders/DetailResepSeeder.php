<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail_resep = collect([
            [
                'no_resep' => 1,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 2,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 3,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 4,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 5,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 6,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 7,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 8,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 9,
                'jumlah_resep' => 1,
            ],
            [
                'no_resep' => 10,
                'jumlah_resep' => 1,
            ]
        ]);

        $detail_resep->each(fn ($put) => DB::table('detail_resep')->insert($put));
    }
}
