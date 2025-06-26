@extends('footerheader.navbar')

@section('content')
<div class="card p-4">
    <h3 class="mb-4 text-center">Detail Data Pasien</h3>

    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
            <div class="mb-3">
                <h5>Identitas Pribadi</h5>
                <hr>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">No RM</div>
                    <div class="col-md-8" id="no_rm">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Nama Lengkap</div>
                    <div class="col-md-8" id="nama_pasien">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Jenis Kelamin</div>
                    <div class="col-md-8" id="jenis_kelamin">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Tempat, Tanggal Lahir</div>
                    <div class="col-md-8" id="ttl">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">No. Telepon</div>
                    <div class="col-md-8" id="no_telp">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Email</div>
                    <div class="col-md-8" id="email">Loading...</div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
            <div class="mb-3">
                <h5>Alamat</h5>
                <hr>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Provinsi</div>
                    <div class="col-md-8" id="provinsi">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Kabupaten/Kota</div>
                    <div class="col-md-8" id="kabupaten">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Kecamatan</div>
                    <div class="col-md-8" id="kecamatan">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Kelurahan</div>
                    <div class="col-md-8" id="kelurahan">Loading...</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 fw-bold">Alamat Lengkap</div>
                    <div class="col-md-8" id="alamat">Loading...</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-resep p-2 px-3"
                onclick="window.location.href='/resepsionis'">
                Back
            </button>
        </div>
    </div>



</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
                const no_rm = "{{ $no_rm }}"; // <-- pastikan ini ada dan tno_rmak null

        axios.get(`/api/resepsionis-detail-pasien/${no_rm}`)
            .then(response => {
                const pasien = response.data.data;

                document.getElementById('no_rm').textContent = pasien.no_rm ?? '-';
                document.getElementById('nama_pasien').textContent = pasien.nama ?? '-';
                document.getElementById('jenis_kelamin').textContent = pasien.jenis_kelamin ?? '-';

                const ttl = `${pasien.tempat_lahir ?? '-'}, ${formatDate(pasien.tanggal_lahir)}`;
                document.getElementById('ttl').textContent = ttl;

                document.getElementById('no_telp').textContent = pasien.no_telp ?? '-';
                document.getElementById('email').textContent = pasien.email ?? '-';

                document.getElementById('provinsi').textContent = pasien.provinsi ?? '-';
                document.getElementById('kabupaten').textContent = pasien.kabupaten ?? '-';
                document.getElementById('kecamatan').textContent = pasien.kecamatan ?? '-';
                document.getElementById('kelurahan').textContent = pasien.kelurahan ?? '-';
                document.getElementById('alamat').textContent = pasien.alamat ?? '-';
            })
            .catch(error => {
                console.error("Gagal mengambil data pasien:", error);
                alert("Gagal mengambil data pasien.");
            });

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
    });
</script>
@endsection