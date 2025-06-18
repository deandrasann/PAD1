<?php

namespace Database\Seeders;

use Hash;
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
        $pasienData = [
            [
                'no_rm' =>'RM1001',
                'nama' => 'John Doe',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-05-15',
                'no_telp' => '081234567890',
                'email' => 'john.doe@example.com',
                'provinsi' => 'DKI Jakarta',
                'kabupaten' => 'Jakarta Pusat',
                'kecamatan' => 'Gambir',
                'kelurahan' => 'Cideng',
                'foto' => 'foto/john_doe.jpg',
            ],
            [
                'no_rm' =>'RM1002',
                'nama' => 'Jane Smith',
                'alamat' => 'Jl. Asia Afrika No. 2, Bandung',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-08-20',
                'no_telp' => '082345678901',
                'email' => 'jane.smith@example.com',
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Bandung',
                'kecamatan' => 'Cicendo',
                'kelurahan' => 'Pasirkaliki',
                'foto' => 'foto/jane_smith.jpg',
            ],
            [
                'no_rm' =>'RM1003',
                'nama' => 'Ali Ahmad',
                'alamat' => 'Jl. Kenjeran No. 10, Surabaya',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1992-12-01',
                'no_telp' => '083456789012',
                'email' => 'ali.ahmad@example.com',
                'provinsi' => 'Jawa Timur',
                'kabupaten' => 'Surabaya',
                'kecamatan' => 'Tambaksari',
                'kelurahan' => 'Gading',
                'foto' => 'foto/ali_ahmad.jpg',
            ],
            [
                'no_rm' =>'RM1004',
                'nama' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Gatot Subroto No. 7, Medan',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1995-03-10',
                'no_telp' => '084567890123',
                'email' => 'siti.nurhaliza@example.com',
                'provinsi' => 'Sumatera Utara',
                'kabupaten' => 'Medan',
                'kecamatan' => 'Medan Kota',
                'kelurahan' => 'Teladan Barat',
                'foto' => 'foto/siti_nurhaliza.jpg',
            ],
            [
                'no_rm' =>'RM1005',
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Malioboro No. 5, Yogyakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1988-07-25',
                'no_telp' => '085678901234',
                'email' => 'budi.santoso@example.com',
                'provinsi' => 'DI Yogyakarta',
                'kabupaten' => 'Yogyakarta',
                'kecamatan' => 'Danurejan',
                'kelurahan' => 'Tegalpanggung',
                'foto' => 'foto/budi_santoso.jpg',
            ],
            [
                'no_rm' =>'RM1006',

                'nama' => 'Dewi Lestari',
                'alamat' => 'Jl. Kuta No. 9, Bali',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '1993-04-17',
                'no_telp' => '086789012345',
                'email' => 'dewi.lestari@example.com',
                'provinsi' => 'Bali',
                'kabupaten' => 'Badung',
                'kecamatan' => 'Kuta',
                'kelurahan' => 'Legian',
                'foto' => 'foto/dewi_lestari.jpg',
            ],
            [
                'no_rm' =>'RM1007',
                'nama' => 'Rudi Setiawan',
                'alamat' => 'Jl. Pahlawan No. 6, Semarang',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1980-11-11',
                'no_telp' => '087890123456',
                'email' => 'rudi.setiawan@example.com',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Semarang',
                'kecamatan' => 'Semarang Tengah',
                'kelurahan' => 'Pandansari',
                'foto' => 'foto/rudi_setiawan.jpg',
            ],
            [
                'no_rm' =>'RM1008',
                'nama' => 'Nina Maulani',
                'alamat' => 'Jl. Engku Putri No. 8, Batam',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Batam',
                'tanggal_lahir' => '1997-09-29',
                'no_telp' => '088901234567',
                'email' => 'nina.maulani@example.com',
                'provinsi' => 'Kepulauan Riau',
                'kabupaten' => 'Batam',
                'kecamatan' => 'Batam Kota',
                'kelurahan' => 'Teluk Tering',
                'foto' => 'foto/nina_maulani.jpg',
            ],
            [
                'no_rm' =>'RM1009',

                'nama' => 'Eko Prasetyo',
                'alamat' => 'Jl. Kapten A. Rivai No. 3, Palembang',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '1991-06-18',
                'no_telp' => '089012345678',
                'email' => 'eko.prasetyo@example.com',
                'provinsi' => 'Sumatera Selatan',
                'kabupaten' => 'Palembang',
                'kecamatan' => 'Ilir Barat I',
                'kelurahan' => 'Siring Agung',
                'foto' => 'foto/eko_prasetyo.jpg',
            ],
            [
                'no_rm' =>'RM1010',
                'nama' => 'Tina Sari',
                'alamat' => 'Jl. AP Pettarani No. 11, Makassar',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '1994-02-02',
                'no_telp' => '090123456789',
                'email' => 'tina.sari@example.com',
                'provinsi' => 'Sulawesi Selatan',
                'kabupaten' => 'Makassar',
                'kecamatan' => 'Panakkukang',
                'kelurahan' => 'Karampuang',
                'foto' => 'foto/tina_sari.jpg',
            ]
        ];

        foreach ($pasienData as $pasien) {
            // Create a user for the current doctor
            $userId = DB::table('users')->insertGetId([
                'id_role' => 'R05', // Assuming 'R02' is the role ID for doctors
                'nama_role' => 'pasien',
                'username' => $pasien['nama'], // Using doctor's name as username
                'email' => $pasien['email'],
                'password' => Hash::make('password123'), // A default password for the user
                'keterangan' => 'User for ' . $pasien['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Assign the newly created user's ID to id_pengguna for the doctor
            $pasien['id_pengguna'] = $userId;

            // Insert the doctor data
            DB::table('pasien')->insert($pasien);
        }
    }
}
