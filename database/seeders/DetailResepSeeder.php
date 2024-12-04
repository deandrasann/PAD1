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
        $dokter = collect([
            [
                'no_resep'       => 1,
                'kode_obat'      => 1,
                'nama_obat'      => 'Paracetamol',
                'dosis'          => 500,
                'aturan_pakai'   => 'Setelah makan',
                'jumlah_resep'   => 30,
                'harga_satuan'   => 5000,
            ],
            [
                'no_resep'       => 1,
                'kode_obat'      => 2,
                'nama_obat'      => 'Ciprofloxacin',
                'dosis'          => 500,
                'aturan_pakai'   => 'Sebelum makan',
                'jumlah_resep'   => 20,
                'harga_satuan'   => 15000,
            ],
            [
                'no_resep'       => 2,
                'kode_obat'      => 3,
                'nama_obat'      => 'Furosemide',
                'dosis'          => 40,
                'aturan_pakai'   => 'Pagi hari',
                'jumlah_resep'   => 30,
                'harga_satuan'   => 7000,
            ],
            [
                'no_resep'       => 2,
                'kode_obat'      => 4,
                'nama_obat'      => 'Amoxicillin',
                'dosis'          => 250,
                'aturan_pakai'   => 'Sebelum makan',
                'jumlah_resep'   => 20,
                'harga_satuan'   => 10000,
            ],
            [
                'no_resep'       => 3,
                'kode_obat'      => 5,
                'nama_obat'      => 'Cetirizine',
                'dosis'          => 10,
                'aturan_pakai'   => 'Sebelum tidur',
                'jumlah_resep'   => 30,
                'harga_satuan'   => 8000,
            ],
            [
                'no_resep'       => 3,
                'kode_obat'      => 6,
                'nama_obat'      => 'Ibuprofen',
                'dosis'          => 400,
                'aturan_pakai'   => 'Setelah makan',
                'jumlah_resep'   => 20,
                'harga_satuan'   => 12000,
            ],
            [
                'no_resep'       => 4,
                'kode_obat'      => 7,
                'nama_obat'      => 'Metformin',
                'dosis'          => 500,
                'aturan_pakai'   => 'Sebelum makan',
                'jumlah_resep'   => 60,
                'harga_satuan'   => 11000,
            ],
            [
                'no_resep'       => 4,
                'kode_obat'      => 8,
                'nama_obat'      => 'Lisinopril',
                'dosis'          => 10,
                'aturan_pakai'   => 'Pagi hari',
                'jumlah_resep'   => 30,
                'harga_satuan'   => 9000,
            ],
            [
                'no_resep'       => 5,
                'kode_obat'      => 9,
                'nama_obat'      => 'Simvastatin',
                'dosis'          => 20,
                'aturan_pakai'   => 'Malam hari',
                'jumlah_resep'   => 30,
                'harga_satuan'   => 13000,
            ],
            [
                'no_resep'       => 5,
                'kode_obat'      => 10,
                'nama_obat'      => 'Amlodipine',
                'dosis'          => 5,
                'aturan_pakai'   => 'Pagi hari',
                'jumlah_resep'   => 30,
                'harga_satuan'   => 8500,
            ]
        ]);

        $dokter->each(fn ($put) => DB::table('dokter')->insert($put));
    }
}
