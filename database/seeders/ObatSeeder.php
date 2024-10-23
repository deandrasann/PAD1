<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obat = collect([
            [
               'id_apoteker' => 1,
                'nama_obat' => 'Paracetamol',
                'takaran_minum' => '500 mg',
                'jml_kali_minum' => '3 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Sesuai resep dokter',
                'jumlah_obat' => '30 tablet',
                'waktu_minum' => 'Setiap 8 jam',
                'keterangan' => 'Jangan melebihi dosis',
                'kontraindikasi' => 'Penyakit hati',
                'pola_makan' => 'Tidak perlu khusus',
                'interaksi_obat' => 'Alkohol dapat meningkatkan risiko kerusakan hati',
                'petunjuk_penyimpanan' => 'Simpan di tempat kering',
                'kekuatan_sediaan' => '500 mg',
                'informasi_tambahan' => 'Tidak untuk anak di bawah 12 tahun',
                'efek_samping' => 'Mual, pusing',
                'indikasi' => 'Nyeri dan demam',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Amoxicillin',
                'takaran_minum' => '250 mg',
                'jml_kali_minum' => '3 kali/hari',
                'bentuk_obat' => 'Kapsul',
                'aturan_pakai' => 'Minum sebelum makan',
                'jumlah_obat' => '20 kapsul',
                'waktu_minum' => '30 menit sebelum makan',
                'keterangan' => 'Gunakan sesuai petunjuk',
                'kontraindikasi' => 'Alergi terhadap penisilin',
                'pola_makan' => 'Setelah makan',
                'interaksi_obat' => 'Antikoagulan dapat memperkuat efek',
                'petunjuk_penyimpanan' => 'Simpan di tempat dingin',
                'kekuatan_sediaan' => '250 mg',
                'informasi_tambahan' => 'Periksa alergi sebelum penggunaan',
                'efek_samping' => 'Diare, ruam kulit',
                'indikasi' => 'Infeksi bakteri',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Cetirizine',
                'takaran_minum' => '10 mg',
                'jml_kali_minum' => '1 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Minum sebelum tidur',
                'jumlah_obat' => '15 tablet',
                'waktu_minum' => 'Malam hari',
                'keterangan' => 'Dapat menyebabkan kantuk',
                'kontraindikasi' => 'Penyakit ginjal',
                'pola_makan' => 'Tidak perlu khusus',
                'interaksi_obat' => 'Alkohol dapat memperburuk efek sedatif',
                'petunjuk_penyimpanan' => 'Simpan di tempat sejuk',
                'kekuatan_sediaan' => '10 mg',
                'informasi_tambahan' => 'Hati-hati saat mengemudi',
                'efek_samping' => 'Kantuk, mulut kering',
                'indikasi' => 'Alergi, rinitis',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Loperamide',
                'takaran_minum' => '2 mg',
                'jml_kali_minum' => '2 kali/hari',
                'bentuk_obat' => 'Kapsul',
                'aturan_pakai' => 'Minum setelah diare',
                'jumlah_obat' => '12 kapsul',
                'waktu_minum' => 'Sesuai kebutuhan',
                'keterangan' => 'Tidak untuk diare berdarah',
                'kontraindikasi' => 'Kolitis',
                'pola_makan' => 'Tidak perlu khusus',
                'interaksi_obat' => 'Hindari kombinasi dengan antibiotik tertentu',
                'petunjuk_penyimpanan' => 'Simpan di tempat kering',
                'kekuatan_sediaan' => '2 mg',
                'informasi_tambahan' => 'Dapat menyebabkan sembelit',
                'efek_samping' => 'Konstipasi, pusing',
                'indikasi' => 'Diare',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Ibuprofen',
                'takaran_minum' => '400 mg',
                'jml_kali_minum' => '3 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Minum setelah makan',
                'jumlah_obat' => '20 tablet',
                'waktu_minum' => 'Setiap 6 jam',
                'keterangan' => 'Jangan melebihi dosis',
                'kontraindikasi' => 'Penyakit ginjal',
                'pola_makan' => 'Setelah makan',
                'interaksi_obat' => 'Meningkatkan risiko pendarahan',
                'petunjuk_penyimpanan' => 'Simpan di tempat kering',
                'kekuatan_sediaan' => '400 mg',
                'informasi_tambahan' => 'Hati-hati pada penderita asma',
                'efek_samping' => 'Sakit kepala, mual',
                'indikasi' => 'Nyeri, peradangan',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Simvastatin',
                'takaran_minum' => '10 mg',
                'jml_kali_minum' => '1 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Minum pada malam hari',
                'jumlah_obat' => '30 tablet',
                'waktu_minum' => 'Malam hari',
                'keterangan' => 'Pemantauan gula darah perlu',
                'kontraindikasi' => 'Penyakit hati',
                'pola_makan' => 'Tidak perlu khusus',
                'interaksi_obat' => 'Beberapa antibiotik dapat mempengaruhi',
                'petunjuk_penyimpanan' => 'Simpan di tempat sejuk',
                'kekuatan_sediaan' => '10 mg',
                'informasi_tambahan' => 'Periksa kadar kolesterol secara rutin',
                'efek_samping' => 'Sakit kepala, nyeri otot',
                'indikasi' => 'Kolesterol tinggi',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Metformin',
                'takaran_minum' => '500 mg',
                'jml_kali_minum' => '2 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Minum bersamaan dengan makanan',
                'jumlah_obat' => '60 tablet',
                'waktu_minum' => 'Saat makan',
                'keterangan' => 'Pemantauan gula darah perlu',
                'kontraindikasi' => 'Penyakit ginjal',
                'pola_makan' => 'Makanan bergizi',
                'interaksi_obat' => 'Alkohol dapat meningkatkan risiko hipoglikemia',
                'petunjuk_penyimpanan' => 'Simpan di tempat sejuk',
                'kekuatan_sediaan' => '500 mg',
                'informasi_tambahan' => 'Hati-hati pada penderita diabetes',
                'efek_samping' => 'Mual, diare',
                'indikasi' => 'Diabetes tipe 2',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Atorvastatin',
                'takaran_minum' => '20 mg',
                'jml_kali_minum' => '1 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Minum di waktu yang sama setiap hari',
                'jumlah_obat' => '30 tablet',
                'waktu_minum' => 'Malam hari',
                'keterangan' => 'Pemantauan kadar lipid perlu',
                'kontraindikasi' => 'Penyakit hati',
                'pola_makan' => 'Tidak perlu khusus',
                'interaksi_obat' => 'Beberapa obat lain dapat mempengaruhi efektivitas',
                'petunjuk_penyimpanan' => 'Simpan di tempat sejuk',
                'kekuatan_sediaan' => '20 mg',
                'informasi_tambahan' => 'Hati-hati pada penderita gangguan otot',
                'efek_samping' => 'Sakit kepala, nyeri otot',
                'indikasi' => 'Kolesterol tinggi',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Aspirin',
                'takaran_minum' => '100 mg',
                'jml_kali_minum' => '1 kali/hari',
                'bentuk_obat' => 'Tablet',
                'aturan_pakai' => 'Minum sebelum makan',
                'jumlah_obat' => '30 tablet',
                'waktu_minum' => 'Pagi hari',
                'keterangan' => 'Dapat menyebabkan pendarahan',
                'kontraindikasi' => 'Alergi aspirin',
                'pola_makan' => 'Makanan bergizi',
                'interaksi_obat' => 'Hindari kombinasi dengan NSAID lain',
                'petunjuk_penyimpanan' => 'Simpan di tempat kering',
                'kekuatan_sediaan' => '100 mg',
                'informasi_tambahan' => 'Hati-hati pada penderita asma',
                'efek_samping' => 'Mual, pusing',
                'indikasi' => 'Pencegahan penyakit jantung',
            ],
            [
                'id_apoteker' => 1,
                'nama_obat' => 'Omeprazole',
                'takaran_minum' => '20 mg',
                'jml_kali_minum' => '1 kali/hari',
                'bentuk_obat' => 'Kapsul',
                'aturan_pakai' => 'Minum sebelum makan',
                'jumlah_obat' => '28 kapsul',
                'waktu_minum' => 'Pagi hari',
                'keterangan' => 'Dapat menyebabkan sakit kepala',
                'kontraindikasi' => 'Alergi omeprazole',
                'pola_makan' => 'Tidak perlu khusus',
                'interaksi_obat' => 'Beberapa obat lain dapat mempengaruhi efektivitas',
                'petunjuk_penyimpanan' => 'Simpan di tempat sejuk',
                'kekuatan_sediaan' => '20 mg',
                'informasi_tambahan' => 'Hati-hati pada penderita penyakit hati',
                'efek_samping' => 'Sakit kepala, diare',
                'indikasi' => 'Penyakit lambung',
            ],
        ]);

        $obat->each(fn ($put) => DB::table('obat')->insert($put));
    }
}