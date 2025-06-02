<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolelevel = collect([
            [
                'id_pengguna' => '1',
                'id_role' => 'R01',
                'nama_role' => 'admin',
                'username' => 'adminpenjaga',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'keterangan' => 'ini admin',
            ],
            [
                'id_pengguna' => '2',
                'id_role' => 'R02',
                'nama_role' => 'dokter',
                'username' => 'dokter1',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('dokter123'),
                'keterangan' => 'ini dokter',
            ],
            [
                'id_pengguna' => '7',
                'id_role' => 'R02',
                'nama_role' => 'dokter',
                'username' => 'dokter2',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('dokter123'),
                'keterangan' => 'ini dokter ke 2',
            ],
            [
                'id_pengguna' => '8',
                'id_role' => 'R02',
                'nama_role' => 'dokter',
                'username' => 'dokter3',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('dokter123'),
                'keterangan' => 'ini dokter ke 3',
            ],
            [
                'id_pengguna' => '3',
                'id_role' => 'R03',
                'nama_role' => 'apoteker',
                'username' => 'apoteker1',
                'email' => 'apoteker@gmail.com',
                'password' => Hash::make('apoteker123'),
                'keterangan' => 'ini apoteker',
            ],
            [
                'id_pengguna' => '4',
                'id_role' => 'R04',
                'nama_role' => 'pengawas',
                'username' => 'pengawas1',
                'email' => 'pengawas@gmail.com',
                'password' => Hash::make('pengawas123'),
                'keterangan' => 'ini pengawas',
            ],
            [
                'id_pengguna' => '5',
                'id_role' => 'R05',
                'nama_role' => 'pasien',
                'username' => 'pasien1',
                'email' => 'pasien@gmail.com',
                'password' => Hash::make('pasien123'),
                'keterangan' => 'ini pasien',
            ],
            [
                'id_pengguna' => '6',
                'id_role' => 'R06',
                'nama_role' => 'resepsionis',
                'username' => 'resepsionis1',
                'email' => 'resepsionis@gmail.com',
                'password' => Hash::make('resepsionis123'),
                'keterangan' => 'ini resepsionis',
            ],
        ]);

        $rolelevel->each(fn($put) => DB::table('users')->insert($put));
    }
}
