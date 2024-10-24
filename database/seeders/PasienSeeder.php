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
                'no_rm' => 1001,
                'nama' => 'John Doe',
                'alamat' => '123 Main St, Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1990-05-15',
                'no_telp' => '081234567890',
                'berat_badan' => '70 kg',
            ],
            [
                'no_rm' => 1002,
                'nama' => 'Jane Smith',
                'alamat' => '456 Elm St, Bandung',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1985-08-20',
                'no_telp' => '082345678901',
                'berat_badan' => '60 kg',
            ],
            [
                'no_rm' => 1003,
                'nama' => 'Ali Ahmad',
                'alamat' => '789 Pine St, Surabaya',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1992-12-01',
                'no_telp' => '083456789012',
                'berat_badan' => '75 kg',
            ],
            [
                'no_rm' => 1004,
                'nama' => 'Siti Nurhaliza',
                'alamat' => '321 Oak St, Medan',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1995-03-10',
                'no_telp' => '084567890123',
                'berat_badan' => '55 kg',
            ],
            [
                'no_rm' => 1005,
                'nama' => 'Budi Santoso',
                'alamat' => '654 Maple St, Yogyakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1988-07-25',
                'no_telp' => '085678901234',
                'berat_badan' => '80 kg',
            ],
            [
                'no_rm' => 1006,
                'nama' => 'Dewi Lestari',
                'alamat' => '987 Birch St, Bali',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1993-04-17',
                'no_telp' => '086789012345',
                'berat_badan' => '50 kg',
            ],
            [
                'no_rm' => 1007,
                'nama' => 'Rudi Setiawan',
                'alamat' => '159 Cedar St, Semarang',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1980-11-11',
                'no_telp' => '087890123456',
                'berat_badan' => '85 kg',
            ],
            [
                'no_rm' => 1008,
                'nama' => 'Nina Maulani',
                'alamat' => '753 Walnut St, Batam',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1997-09-29',
                'no_telp' => '088901234567',
                'berat_badan' => '54 kg',
            ],
            [
                'no_rm' => 1009,
                'nama' => 'Eko Prasetyo',
                'alamat' => '852 Cherry St, Palembang',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1991-06-18',
                'no_telp' => '089012345678',
                'berat_badan' => '78 kg',
            ],
            [
                'no_rm' => 1010,
                'nama' => 'Tina Sari',
                'alamat' => '246 Fir St, Makassar',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1994-02-02',
                'no_telp' => '090123456789',
                'berat_badan' => '62 kg',
            ],
        ]);

        $pasien->each(fn ($put) => DB::table('pasien')->insert($put));
    }
}
