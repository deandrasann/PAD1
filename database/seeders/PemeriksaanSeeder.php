<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemeriksaaan = collect([
            [
                'nama_dokter' => 1, // ID dokter
                'id_pasien' => 1, // ID pasien
                'kode_icd' => 'A00',
                'anamnesa' => 'Demam tinggi dan batuk',
                'pemeriksaan_fisik' => 'Tensi normal, suara napas sedikit mengi',
                'jenis_diagnosa' => 'Penyakit Menular',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-01',
                'pemeriksaan_penunjang' => 'Rontgen dada',
                'catatan' => 'Pasien perlu diobservasi',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 2,
                'kode_icd' => 'B01',
                'anamnesa' => 'Nyeri perut bagian bawah',
                'pemeriksaan_fisik' => 'Nyeri tekan di perut kiri',
                'jenis_diagnosa' => 'Penyakit Dalam',
                'jenis_kasus' => 'Rawat Inap',
                'tgl_diagnosa' => '2023-10-02',
                'pemeriksaan_penunjang' => 'USG abdomen',
                'catatan' => 'Perlu pemeriksaan lanjutan',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 3,
                'kode_icd' => 'C03',
                'anamnesa' => 'Sakit kepala berat',
                'pemeriksaan_fisik' => 'Kepala sensitif, pusing',
                'jenis_diagnosa' => 'Neurologis',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-03',
                'pemeriksaan_penunjang' => 'CT Scan kepala',
                'catatan' => 'Monitoring tekanan darah',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 4,
                'kode_icd' => 'D02',
                'anamnesa' => 'Batuk berdahak',
                'pemeriksaan_fisik' => 'Suara napas tereduksi',
                'jenis_diagnosa' => 'Penyakit Paru',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-04',
                'pemeriksaan_penunjang' => 'Tes fungsi paru',
                'catatan' => 'Berikan inhaler',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 5,
                'kode_icd' => 'E04',
                'anamnesa' => 'Kelelahan dan haus berlebih',
                'pemeriksaan_fisik' => 'BMI tinggi, glukosa darah meningkat',
                'jenis_diagnosa' => 'Diabetes',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-05',
                'pemeriksaan_penunjang' => 'Tes glukosa',
                'catatan' => 'Diet rendah gula',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 6,
                'kode_icd' => 'F01',
                'anamnesa' => 'Kecemasan berlebihan',
                'pemeriksaan_fisik' => 'Pulsasi cepat, berkeringat',
                'jenis_diagnosa' => 'Gangguan Mental',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-06',
                'pemeriksaan_penunjang' => 'Konsultasi psikologi',
                'catatan' => 'Jadwalkan terapi',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 7,
                'kode_icd' => 'G02',
                'anamnesa' => 'Kesemutan di tangan dan kaki',
                'pemeriksaan_fisik' => 'Refleks menurun',
                'jenis_diagnosa' => 'Neuropati',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-07',
                'pemeriksaan_penunjang' => 'Tes darah',
                'catatan' => 'Pertimbangkan MRI',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 8,
                'kode_icd' => 'H01',
                'anamnesa' => 'Penglihatan kabur',
                'pemeriksaan_fisik' => 'Tes penglihatan menurun',
                'jenis_diagnosa' => 'Penyakit Mata',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-08',
                'pemeriksaan_penunjang' => 'Pemeriksaan mata',
                'catatan' => 'Perlu rujukan ke spesialis',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 9,
                'kode_icd' => 'I01',
                'anamnesa' => 'Nyeri dada',
                'pemeriksaan_fisik' => 'EKG normal, detak jantung cepat',
                'jenis_diagnosa' => 'Kardiovaskular',
                'jenis_kasus' => 'Rawat Inap',
                'tgl_diagnosa' => '2023-10-09',
                'pemeriksaan_penunjang' => 'Ekokardiogram',
                'catatan' => 'Monitoring di ICU',
            ],
            [
                'nama_dokter' => 1,
                'id_pasien' => 10,
                'kode_icd' => 'J02',
                'anamnesa' => 'Sakit tenggorokan',
                'pemeriksaan_fisik' => 'Radang tenggorokan, amandel membesar',
                'jenis_diagnosa' => 'Infeksi Saluran Pernapasan',
                'jenis_kasus' => 'Rawat Jalan',
                'tgl_diagnosa' => '2023-10-10',
                'pemeriksaan_penunjang' => 'Tes rapid',
                'catatan' => 'Berikan antibiotik jika perlu',
            ],
        ]);

        $pemeriksaaan->each(fn ($put) => DB::table('pemeriksaan')->insert($put));
    }
}
