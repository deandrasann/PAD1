# Sistem Manajemen Klinik Apotech.id

Sistem Manajemen Klinik **Apotech.id** adalah aplikasi berbasis web yang bertujuan untuk meningkatkan efisiensi operasional klinik. Sistem ini mendukung berbagai peran pengguna seperti **apoteker, dokter, pasien, pengawas**, dan **resepsionis**, dengan fitur yang disesuaikan berdasarkan kebutuhan dan tanggung jawab masing-masing.

![Last Commit](https://img.shields.io/github/last-commit/deandrasann/PAD1?label=last%20commit)
![Blade](https://img.shields.io/badge/blade-62.0%25-blue)
![Languages](https://img.shields.io/github/languages/count/deandrasann/PAD1)

---

## 📚 Table of Contents
- [Fitur Utama](#fitur-utama)
  - [Modul Apoteker](#modul-apoteker)
  - [Modul Dokter](#modul-dokter)
  - [Modul Pasien](#modul-pasien)
  - [Modul Pengawas](#modul-pengawas)
  - [Modul Resepsionis](#modul-resepsionis)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Instalasi](#instalasi)
- [Kontribusi](#kontribusi)
- [Tautan Penting](#tautan-penting)
- [Tim Pengembang](#tim-pengembang)
- [Lisensi](#lisensi)

---

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

### Modul Resepsionis
- Melihat list pasien
- Mengelola database pasien (CRUD)
- Mengisi pendataan awal dan keluhan pasien
- Memasukkan pasien ke rawat jalan

---

## Teknologi yang Digunakan

![Laravel](https://img.shields.io/badge/-Laravel-red?logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/-Bootstrap-7952B3?logo=bootstrap&logoColor=white)
![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=white)
![jQuery](https://img.shields.io/badge/-jQuery-0769AD?logo=jquery&logoColor=white)
![GitHub](https://img.shields.io/badge/-GitHub-181717?logo=github&logoColor=white)
---

## Instalasi
Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:
1.  **Clone repository ini:**
    ```bash
    git clone [https://github.com/deandrasann/PAD1.git](https://github.com/deandrasann/PAD1.git)
    cd PAD1
    ```
2.  **Install semua dependencies:**
    ```bash
    composer install && npm install
    ```
3.  **Setup Environment:**
    Buat salinan dari file `.env.example` dan beri nama `.env`.
    ```bash
    cp .env.example .env
    ```
    Kemudian, sesuaikan konfigurasi database di dalam file `.env` Anda.

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi dan Seeder Database:**
    Perintah ini akan membuat struktur tabel dan mengisi data awal.
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.

    <hr>

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
