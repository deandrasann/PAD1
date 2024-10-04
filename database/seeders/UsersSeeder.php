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
                'id_role' => 'R01',
                'nama_role' => 'admin',
                'username' => 'adminpenjaga',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'keterangan' => 'ini admin'
            ],
            [
                'id_role' => 'R02',
                'nama_role' => 'dokter',
                'username' => 'dokter1',
                'email' => 'dokter@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('dokter123'),
                'keterangan' => 'ini dokter'
            ],
            [
                'id_role' => 'R03',
                'nama_role' => 'apoteker',
                'username' => 'apoteker1',
                'email' => 'apoteker@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('apoteker123'),
                'keterangan' => 'ini apoteker'
            ],
            [
                'id_role' => 'R04',
                'nama_role' => 'pengawas',
                'username' => 'pengawas1',
                'email' => 'pengawas@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pengawas123'),
                'keterangan' => 'ini pengawas'
            ],
            [
                'id_role' => 'R05',
                'nama_role' => 'pasien',
                'username' => 'pasien1',
                'email' => 'pasien@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pasien123'),
                'keterangan' => 'ini pasien'
            ],
        ]);

        $rolelevel->each(fn($put) => DB::table('users')->insert($put));
    }
}
