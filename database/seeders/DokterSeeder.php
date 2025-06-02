<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokter = collect([
            [
                'id_dokter' => '1',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232131',
                'jenis_dokter' => 'dokterspesial',
                'spesialis' => 'spesial aja sih',
                'nama_dokter' => 'dokter1',
                'kode_bpjs' => '321321',
            ],
            [
                'id_dokter' => '2',
                'id_pengguna' => '7',
                'kode_klinik' => '1',
                'kode_dokter' => '1232132',
                'jenis_dokter' => 'umum',
                'spesialis' => 'tidak ada',
                'nama_dokter' => 'dokter2',
                'kode_bpjs' => '321322',
            ],
            [
                'id_dokter' => '3',
                'id_pengguna' => '8',
                'kode_klinik' => '1',
                'kode_dokter' => '1232133',
                'jenis_dokter' => 'gigi',
                'spesialis' => 'gigi umum',
                'nama_dokter' => 'dokter3',
                'kode_bpjs' => '321323',
            ],
            [
                'id_dokter' => '4',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232134',
                'jenis_dokter' => 'anak',
                'spesialis' => 'anak-anak',
                'nama_dokter' => 'dokter4',
                'kode_bpjs' => '321324',
            ],
            [
                'id_dokter' => '5',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232135',
                'jenis_dokter' => 'mata',
                'spesialis' => 'oftalmologi',
                'nama_dokter' => 'dokter5',
                'kode_bpjs' => '321325',
            ],
            [
                'id_dokter' => '6',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232136',
                'jenis_dokter' => 'bedah',
                'spesialis' => 'umum',
                'nama_dokter' => 'dokter6',
                'kode_bpjs' => '321326',
            ],
            [
                'id_dokter' => '7',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232137',
                'jenis_dokter' => 'paru',
                'spesialis' => 'pulmonologi',
                'nama_dokter' => 'dokter7',
                'kode_bpjs' => '321327',
            ],
            [
                'id_dokter' => '8',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232138',
                'jenis_dokter' => 'jantung',
                'spesialis' => 'kardiologi',
                'nama_dokter' => 'dokter8',
                'kode_bpjs' => '321328',
            ],
            [
                'id_dokter' => '9',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232139',
                'jenis_dokter' => 'syaraf',
                'spesialis' => 'neurologi',
                'nama_dokter' => 'dokter9',
                'kode_bpjs' => '321329',
            ],
            [
                'id_dokter' => '10',
                'id_pengguna' => '2',
                'kode_klinik' => '1',
                'kode_dokter' => '1232140',
                'jenis_dokter' => 'kulit',
                'spesialis' => 'dermatologi',
                'nama_dokter' => 'dokter10',
                'kode_bpjs' => '321330',
            ],
        ]);

        $dokter->each(fn ($put) => DB::table('dokter')->insert($put));
    }
}
