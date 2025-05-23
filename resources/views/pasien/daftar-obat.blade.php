@extends('footerheader.navbar-pmo')
@section('content')
<div class="py-2 w-100">
    <div class="d-flex align-items-start mb-4">
        <a href="{{ route('hasil.scan') }}">
            <img src="{{ asset('images/ic_round-navigate-next.png') }}" alt="Back" class="me-2">
        </a>
        <h2 class="fw-bold text-center mb-4 flex-grow-1" style="color:black">Obat Anda</h2>
    </div>

    <!-- Card Obat -->
    <div class="card mb-3 p-4 card-custom">
      <h5 class="fw-bold">Amlodipine Tablet 10 mg</h5>
      <p class="mb-3">Status: Proses Pengobatan</p>
      <div class="d-flex gap-2">
        <button class="btn btn-resep">
          <i class="fas fa-info-circle"></i> <a href="{{route('detail-obat-pasien')}}" style="color: white; text-decoration:none">Detail Obat</a>
        </button>
        <button class="btn btn-warning" style="color: white; background-color:#FFA827">
          <i class="fas fa-cogs"></i> <a href="{{route('atur-jadwal')}}" style="color: white; text-decoration:none">Atur Jadwal Minum</a>
        </button>
      </div>
    </div>

    <div class="card mb-3 p-4 card-custom">
        <h5 class="fw-bold">Amlodipine Tablet 10 mg</h5>
        <p class="mb-3">Status: Proses Pengobatan</p>
        <div class="d-flex gap-2">
          <button class="btn btn-resep">
            <i class="fas fa-info-circle"></i> <a href="{{route('detail-obat-pasien')}}" style="color: white; text-decoration:none">Detail Obat</a>
          </button>
          <button class="btn btn-warning" style="color: white; background-color:#FFA827">
            <i class="fas fa-cogs"></i> <a href="{{route('atur-jadwal')}}" style="color: white; text-decoration:none">Atur Jadwal Minum</a>
          </button>
        </div>
      </div>


  </div>
@endsection
