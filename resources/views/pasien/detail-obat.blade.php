@extends('footerheader.navbar-pmo')
@section('content')
<div class="d-flex align-items-start mb-4">
    <a href="{{ route('daftar-obat-pasien') }}">
        <img src="{{ asset('images/ic_round-navigate-next.png') }}" alt="Back" class="me-2">
    </a>
    <h2 class="fw-bold text-center mb-4 flex-grow-1" style="color:black">Detail Obat Anda</h2>
</div>
<div class="mb-3 text-dark">
    <strong>Nama</strong><br>
    Amlodipine Tablet 10 mg
  </div>
  <div class="mb-3 text-dark">
    <strong>Dosis</strong><br>
    10 mg
  </div>
  <div class="mb-3 text-dark">
    <strong>Aturan pakai</strong><br>
    3 Kali Sehari 1 Tablet
  </div>
  <div class="mb-3 text-dark">
    <strong>Waktu Minum</strong><br>
    Sebelum Makan
  </div>
  <div class="mb-3 text-dark">
    <strong>Keterangan</strong><br>
    Harus Habis, ditelan utuh dengan air, tidak boleh digerus
  </div>
  <div class="mb-3 text-dark">
    <strong>Jumlah Kali Minum</strong><br>
    Jumlah Kali Minum
  </div>
  <div class="mb-3 text-dark">
    <strong>Jumlah Obat</strong><br>
    Jumlah Obat
  </div>
  <div class="mb-3 text-dark">
    <strong>Efek Samping</strong><br>
    Pusing atau sakit kepala, pembengkakan pada kaki
  </div>
  <div class="mb-3 text-dark">
    <strong>Kontraindikasi</strong><br>
    Tekanan darah sangat rendah (hipotensi berat)
  </div>
  <div class="mb-3 text-dark">
    <strong>Interaksi Obat</strong><br>
    simvastatin
  </div>
  <div class="mb-3 text-dark">
    <strong>Pola Makan dan Hidup Sehat</strong><br>
    Batasi konsumsi garam dan makanan tinggi natrium
  </div>
  <div class="mb-4 text-dark">
    <strong>Informasi Tambahan</strong><br>
    Jangan minum obat dengan susu, teh, atau jus jeruk
  </div>
  <div class="text-center">
    <a href="{{ route('daftar-obat-pasien') }}" class="btn btn-resep px-4">Kembali</a>
  </div>
@endsection
