# Sistem Manajemen Klinik Apotech.id

## Deskripsi Proyek
Sistem Manajemen Klinik Apotech.id adalah aplikasi berbasis web yang bertujuan untuk meningkatkan efisiensi operasional klinik. Sistem ini mendukung berbagai peran pengguna seperti apoteker, dokter, pasien, pengawas, dan resepsionis, dengan fitur yang disesuaikan berdasarkan kebutuhan dan tanggung jawab masing-masing.

## Fitur Utama

### Modul Apoteker
- Melihat list pasien
- Menampilkan list obat
- Mengelola database obat (CRUD)
- Melihat riwayat pemeriksaan
- Melihat riwayat resep
- Mencetak resep
- Melihat obat yang paling sering digunakan

### Modul Dokter
- Melihat list pasien rawat jalan
- Melakukan pemeriksaan
- Merumuskan obat
- Melihat riwayat pemeriksaan
- Melihat riwayat resep
- Mendapatkan informasi pasien

### Modul Pasien
- Generate barkode
- Melihat informasi pribadi
- Melihat resep yang dipindai
- Melihat riwayat resep
- Mendapatkan notifikasi minum obat
- Mengisi tracker minum obat

### Modul Pengawas
- Login/otentikasi akun pengawas
- Menampilkan informasi singkat pasien
- Menampilkan tracker pasien

### Modul Resepsionis
- Melihat list pasien
- Mengelola database pasien (CRUD)
- Mengisi pendataan awal dan keluhan pasien
- Memasukkan pasien ke rawat jalan

## Teknologi yang Digunakan
- **Backend**: PHP (Laravel 11)
- **Frontend**: HTML, CSS, JavaScript, jQuery
- **Database**: MySQL (Versi 8.1.0-1.e18)
- **Sistem Operasi**: Windows 10
- **Repository**: GitHub

## Instalasi
1. Clone repository:
   `git clone https://github.com/deandrasann/PAD1.git`
2. Install dependencies:
   `composer install && npm install`
3. Buat file `.env` dan sesuaikan konfigurasi database.
4. Jalankan migrasi dan seeder:
   `php artisan migrate --seed`
5. Jalankan aplikasi:
   `php artisan serve`

## Kontribusi
Kami membuka peluang kontribusi untuk pengembangan sistem ini. Silakan fork repository, buat branch baru, dan kirim pull request.

## Tautan Penting
- **Repository GitHub**: [https://github.com/deandrasann/PAD1](https://github.com/deandrasann/PAD1)
- **Desain Figma**: [https://www.figma.com/design/RPs4KukBOB3QurfbWn5Kw/ui-apotech.id](https://www.figma.com/design/RPs4KukBOB3QurfbWn5Kw/ui-apotech.id)

## Tim Pengembang
- **Project Manager**: Septyan Yaumul Fatkhan
- **UI/UX Designer**: Marsha Bilqis Nasywa
- **Frontend Developer**: Deandra Santoso
- **Backend Developer**: Joe Sozanolo Waruwu

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

© 2024 Apotech.id. All rights reserved.
