<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Don't forget to import Hash

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorsData = [
            [
                'id_dokter' => '1',
                'kode_klinik' => '1',
                'kode_dokter' => '1232131',
                'jenis_dokter' => 'dokterspesial',
                'email' => 'dokter1@gmail.com',
                'spesialis' => 'spesial aja sih',
                'nama_dokter' => 'dokter1',
                'kode_bpjs' => '321321',
            ],
            [
                'id_dokter' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232132',
                'jenis_dokter' => 'umum',
                'email' => 'dokter2@gmail.com',
                'spesialis' => 'tidak ada',
                'nama_dokter' => 'dokter2',
                'kode_bpjs' => '321322',
            ],
            [
                'id_dokter' => '3',
                'kode_klinik' => '1',
                'kode_dokter' => '1232133',
                'jenis_dokter' => 'gigi',
                'email' => 'dokter3@gmail.com',
                'spesialis' => 'gigi umum',
                'nama_dokter' => 'dokter3',
                'kode_bpjs' => '321323',
            ],
            [
                'id_dokter' => '4',
                'kode_klinik' => '1',
                'kode_dokter' => '1232134',
                'jenis_dokter' => 'anak',
                'email' => 'dokter4@gmail.com',
                'spesialis' => 'anak-anak',
                'nama_dokter' => 'dokter4',
                'kode_bpjs' => '321324',
            ],
            [
                'id_dokter' => '5',
                'kode_klinik' => '1',
                'kode_dokter' => '1232135',
                'jenis_dokter' => 'mata',
                'email' => 'dokter5@gmail.com',
                'spesialis' => 'oftalmologi',
                'nama_dokter' => 'dokter5',
                'kode_bpjs' => '321325',
            ],
            [
                'id_dokter' => '6',
                'kode_klinik' => '1',
                'kode_dokter' => '1232136',
                'jenis_dokter' => 'bedah',
                'email' => 'dokter6@gmail.com',
                'spesialis' => 'umum',
                'nama_dokter' => 'dokter6',
                'kode_bpjs' => '321326',
            ],
            [
                'id_dokter' => '7',
                'kode_klinik' => '1',
                'kode_dokter' => '1232137',
                'jenis_dokter' => 'paru',
                'email' => 'dokter7@gmail.com',
                'spesialis' => 'pulmonologi',
                'nama_dokter' => 'dokter7',
                'kode_bpjs' => '321327',
            ],
            [
                'id_dokter' => '8',
                'kode_klinik' => '1',
                'kode_dokter' => '1232138',
                'jenis_dokter' => 'jantung',
                'email' => 'dokter8@gmail.com',
                'spesialis' => 'kardiologi',
                'nama_dokter' => 'dokter8',
                'kode_bpjs' => '321328',
            ],
            [
                'id_dokter' => '9',
                'kode_klinik' => '1',
                'kode_dokter' => '1232139',
                'jenis_dokter' => 'syaraf',
                'email' => 'dokter9@gmail.com',
                'spesialis' => 'neurologi',
                'nama_dokter' => 'dokter9',
                'kode_bpjs' => '321329',
            ],
            [
                'id_dokter' => '10',
                'kode_klinik' => '1',
                'kode_dokter' => '1232140',
                'jenis_dokter' => 'kulit',
                'email' => 'dokter10@gmail.com',
                'spesialis' => 'dermatologi',
                'nama_dokter' => 'dokter10',
                'kode_bpjs' => '321330',
            ],
        ];

        foreach ($doctorsData as $doctor) {
            // Create a user for the current doctor
            $userId = DB::table('users')->insertGetId([
                'id_role' => 'R02', // Assuming 'R02' is the role ID for doctors
                'nama_role' => 'dokter',
                'username' => $doctor['nama_dokter'], // Using doctor's name as username
                'email' => $doctor['email'],
                'password' => Hash::make('password123'), // A default password for the user
                'keterangan' => 'User for ' . $doctor['nama_dokter'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Assign the newly created user's ID to id_pengguna for the doctor
            $doctor['id_pengguna'] = $userId;

            // Insert the doctor data
            DB::table('dokter')->insert($doctor);
        }
    }
}