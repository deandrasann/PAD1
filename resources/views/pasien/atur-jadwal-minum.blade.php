@extends('footerheader.navbar-pmo')
@section('content')
<div class="d-flex align-items-start mb-4">
    <a href="{{ route('daftar-obat-pasien') }}">
        <img src="{{ asset('images/ic_round-navigate-next.png') }}" alt="Back" class="me-2">
    </a>
    <h2 class="fw-bold text-center mb-4 flex-grow-1" style="color:black">Atur Jadwal Minum Obat Anda</h2>
</div>
<div class="mb-3 text-dark me-4">
    <strong>Aturan pakai</strong><br>
    {{-- 3x ini nentuin jumlah waktu dibawahnya --}}
    3 Kali Sehari 1 Tablet
</div>
<hr>


<div class="mb-3 text-dark">
    <label for="waktu1" class="form-label">Waktu 1</label>
    <div class="input-group">
      <input type="time" class="form-control waktu-input" id="waktu1" placeholder="Masukkan waktu minum obat">
    </div>
</div>

<div class="mb-3 text-dark">
    <label for="waktu2" class="form-label">Waktu 2</label>
    <div class="input-group">
      <input type="time" class="form-control waktu-input" id="waktu2" placeholder="Masukkan waktu minum obat">
    </div>
</div>

<div class="mb-3 text-dark">
    <label for="waktu3" class="form-label">Waktu 3</label>
    <div class="input-group">
      <input type="time" class="form-control waktu-input" id="waktu3" placeholder="Masukkan waktu minum obat">
    </div>
</div>

  <!-- Checkbox Isi Otomatis -->
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" id="isiOtomatis">
    <label class="form-check-label" for="isiOtomatis">
      Isi Otomatis
    </label>
</div>

<hr>

<div class="mb-3 text-dark">
    <label for="waktu1" class="form-label">Mulai Tanggal</label>
    <div class="input-group">
      <input type="date" class="form-control bg-light border-0 px-3 py-2 rounded-start" id="waktu1" value="18:00">
      <span class="input-group-text bg-light border-0 rounded-end">
      </span>
    </div>
</div>
<hr>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="checkboxBiru">
    <label class="form-check-label" for="checkboxBiru">
        Kirim notifikasi saat waktu minum
     </label>
</div>
<div class="d-flex justify-content-between mt-4">
    <a class="btn btn-light border border-dark" href="{{route('daftar-obat-pasien')}}">Batal</a>
    <a class="btn btn-resep " href="{{route('daftar-obat-pasien')}}">Simpan</a>
</div>


<script>
    document.getElementById("isiOtomatis").addEventListener("change", function () {
      const inputs = document.querySelectorAll(".waktu-input");
      const totalInputs = inputs.length;

      if (this.checked) {
        // Hitung interval berdasarkan 24 jam
        const interval = Math.floor(24 / totalInputs);
        let jam = 6; // Waktu awal jam 6 pagi

        inputs.forEach((input, index) => {
          let hours = (jam + index * interval) % 24;
          let formatted = `${hours.toString().padStart(2, '0')}:00`;
          input.value = formatted;
          input.removeAttribute("placeholder");
        });

      } else {
        inputs.forEach(input => {
          input.value = "";
          input.setAttribute("placeholder", "Masukkan waktu minum obat");
        });
      }
    });
  </script>
@endsection
