@extends('footerheader.navbar-pmo')
@section('content')

<style>
    .nav-link.active {
        color: white !important;
    }
    .nav-link:hover {
    color: white !important;
}
.nav-pills .nav-link {
    color: #848488 !important;
    background-color: transparent;
}

.nav-pills .nav-link.active {
    color: #2E6084 !important;
    background-color: white !important; /* Atau warna background lain */
    box-shadow: -4px 0 8px -4px rgba(0, 0, 0, 0.2),  /* kiri */
                4px 0 8px -4px rgba(0, 0, 0, 0.2);   /* kanan */

}

.nav-pills .nav-link:hover {
    color: #2E6084 !important;
}

</style>

<ul class="nav nav-pills flex-row flex-wrap mb-3 gap-0 justify-content-between align-items-center" id="pills-tab" role="tablist" style="background-color: #EFEFF0">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
            aria-selected="true">Peme- <br>riksaan<br>Anda</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
            aria-selected="false">Jadwal <br> Minum <br> Obat</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
            aria-selected="false">Riwayat <br> Minum <br> Obat</button>
    </li>
</ul>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card p-4 my-2">
            <div class="my-2">
                <strong>
                    <div class="label">Tanggal Pemeriksaan</div>
                    <div id="tanggal_pemeriksaan"></div>
                </strong>

            </div>

            <div class="doctor-info">
                <div id="nama_dokter"></div>
                <div id="spesialis_dokter"></div>
            </div>
            <a href="{{route('daftar-obat-pasien')}}" class="d-flex justify-content-end" style="text-decoration: none; color:black"> Lihat Obat <span class="fw-bold ms-4"> > </span></a>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div id="list-jadwal-minum-obat"></div>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
       <div id="list-riwayat-minum-obat"></div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Fungsi untuk mengambil dan menampilkan data jadwal
        function fetchData() {
            $.ajax({
                url: '{{ route('api.pasien.hasil-scan') }}',
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        let hasilData = response.data;
                        if(hasilData.data_pasien) {
                            $('#sidebar_norm').text(hasilData.data_pasien.no_rm);
                            $('#sidebar_nama').text(hasilData.data_pasien.nama);
                            $('#sidebar_jeniskelamin').text(hasilData.data_pasien.jenis_kelamin);
                            $('#sidebar_tanggallahir').text(hasilData.data_pasien.tanggal_lahir);
                            $('#sidebar_notelp').text(hasilData.data_pasien.no_telp);
                            $('#sidebar_alamat').text(hasilData.data_pasien.alamat);
                        } else {
                            console.warn('Data pasien tidak ditemukan.');
                        }
                        if(hasilData.data_pemeriksaan) {
                            const dateString = hasilData.data_pemeriksaan.created_at;
                            const date = new Date(dateString);

                            const year = date.getFullYear();
                            const month = date.getMonth() + 1; // getMonth() is 0-indexed
                            const day = date.getDate();
                            // const hours = date.getHours();
                            // const minutes = date.getMinutes();
                            // const seconds = date.getSeconds();

                            $('#tanggal_pemeriksaan').text(`${day}/${month}/${year}`);
                            $('#nama_dokter').text(hasilData.data_pemeriksaan.dokter.nama_dokter);
                            $('#spesialis_dokter').text(hasilData.data_pemeriksaan.dokter.spesialis);


                        } else {
                            console.warn('Data pemeriksaan tidak ditemukan.');
                        }

                        if(hasilData.data_minum_obat && Array.isArray(hasilData.data_minum_obat)) {
                            let jadwalHtml = '';
                            let riwayatHtml = '';
                            const now = new Date(); // Waktu saat ini
                            
                            hasilData.data_minum_obat.forEach(function(item) {
                                // Periksa apakah item.jam_minum adalah string dan tidak kosong
                                const [hours, minutes, seconds] = item.jam_minum.split(':').map(Number);
                                const itemDateTime = new Date(item.tanggal_minum);
                                itemDateTime.setHours(hours, minutes, 0, 0);
                                console.log(itemDateTime)

                                // Membedakan antara Jadwal dan Riwayat
                                if (itemDateTime > now) {
                                    // Ini adalah jadwal yang akan datang
                                    jadwalHtml += `
                                        <div class="card p-4 mb-5">
                                            <form class="update-status-form" data-id="${item.id_riwayat}">
                                                @csrf {{-- Tambahkan CSRF token --}}
                                                <div class="time-info d-flex justify-content-between mb-3">
                                                    <div class="fw-bold">Tanggal : ${item.tanggal_minum}</div>
                                                    <div class="fw-bold">Jam : ${item.jam_minum}</div>
                                                </div>
                                                <hr>
                                                <div class="mb-4">
                                                    <p class="card-title fw-bold">Nama Obat: ${item.nama_obat}</p>
                                                    <p class="card-text">Aturan Pakai: ${item.aturan_pakai}</p>
                                                </div>
                                                <div>
                                                    <h6 class="mb-3">Status:</h6>
                                                    <div class="d-flex align-items-start flex-column">
                                                        <div class="form-check status-option">
                                                            <input class="form-check-input" type="radio" name="status" id="sudahMinum-${item.id_riwayat}" value="sudah_minum" ${item.status === 'sudah_minum' ? 'checked' : ''}>
                                                            <label class="form-check-label text-success" for="sudahMinum-${item.id_riwayat}">
                                                                Sudah Minum
                                                            </label>
                                                        </div>
                                                        <div class="form-check status-option">
                                                            <input class="form-check-input" type="radio" name="status" id="tundaMinum-${item.id_riwayat}" value="tunda_minum" ${item.status === 'tunda_minum' ? 'checked' : ''}>
                                                            <label class="form-check-label text-primary" for="tundaMinum-${item.id_riwayat}">
                                                                Tunda Minum
                                                            </label>
                                                        </div>
                                                        <div class="form-check status-option">
                                                            <input class="form-check-input" type="radio" name="status" id="tidakMinum-${item.id_riwayat}" value="tidak_minum" ${item.status === 'tidak_minum' ? 'checked' : ''}>
                                                            <label class="form-check-label text-danger" for="tidakMinum-${item.id_riwayat}">
                                                                Tidak Minum
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button class="btn btn-resep" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    `;
                                } else {
                                    // Ini adalah riwayat (sudah lewat waktu atau status sudah diubah)
                                    let statusText = '';
                                    let statusClass = '';
                                    if (item.status === 'sudah_minum') {
                                        statusText = 'Sudah Minum';
                                        statusClass = 'text-success';
                                    } else if (item.status === 'tunda_minum') {
                                        statusText = 'Tunda Minum';
                                        statusClass = 'text-primary'; // Menggunakan text-primary untuk tunda minum
                                    } else if (item.status === 'tidak_minum') {
                                        statusText = 'Tidak Minum';
                                        statusClass = 'text-danger';
                                    } else {
                                        statusText = 'Belum Minum (Terlewat)';
                                        statusClass = 'text-warning'; // Untuk jadwal yang terlewat tapi belum diubah
                                    }

                                    riwayatHtml += `
                                        <div class="card p-4 mb-5">
                                            <div class="time-info d-flex justify-content-between mb-3">
                                                <div class="fw-bold">Tanggal : ${item.tanggal_minum}</div>
                                                <div class="fw-bold">Jam : ${item.jam_minum}</div>
                                            </div>
                                            <hr>
                                            <div class="mb-4">
                                                <p class="card-title fw-bold">Nama Obat: ${item.nama_obat}</p>
                                                <p class="card-text">Aturan Pakai: ${item.aturan_pakai}</p>
                                            </div>
                                            <div>
                                                <h6 class="mb-3">Status:</h6>
                                                <p class="${statusClass}">${statusText}</p>
                                            </div>
                                        </div>
                                    `;
                                }
                            });
                            $('#list-jadwal-minum-obat').html(jadwalHtml || '<p class="text-center">Tidak ada jadwal minum obat yang akan datang.</p>');
                            $('#list-riwayat-minum-obat').html(riwayatHtml || '<p class="text-center">Tidak ada riwayat minum obat.</p>');

                            // Attach event listener to the forms after they are rendered
                            attachFormSubmitListener();

                        } else {
                            $('#list-jadwal-minum-obat').html('<p class="text-center">Data jadwal obat tidak ditemukan atau kosong.</p>');
                            $('#list-riwayat-minum-obat').html('<p class="text-center">Data riwayat obat tidak ditemukan atau kosong.</p>');
                        }

                    } else {
                        alert('Gagal mengambil data: ' + response.message);
                        console.error('API Error:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + error + " | Response: " + xhr.responseText);
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });
        }

        // Fungsi untuk melampirkan event listener ke form update status
        function attachFormSubmitListener() {
            $('.update-status-form').off('submit').on('submit', function(e) {
                e.preventDefault(); // Mencegah form submit default

                const form = $(this);
                const jadwalId = form.data('id');
                const selectedStatus = form.find('input[name="status"]:checked').val();

                if (!selectedStatus) {
                    alert('Mohon pilih status minum obat.');
                    return;
                }

                $.ajax({
                    url: `/api/pasien/jadwal-minum/${jadwalId}`, // URL POST/PUT ke API
                    method: 'POST', // Menggunakan POST karena method "PUT" tidak didukung langsung oleh form HTML
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                        _method: 'PUT', // Mengindikasikan ini adalah permintaan PUT di Laravel
                        status: selectedStatus
                    },
                    beforeSend: function() {
                        form.find('button[type="submit"]').prop('disabled', true).text('Menyimpan...');
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Status minum obat berhasil diperbarui!');
                            fetchData(); // Muat ulang data untuk merefleksikan perubahan
                        } else {
                            alert('Gagal memperbarui status: ' + response.message);
                            console.error('API Error:', response.message, response.errors);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error updating status:", status, error, xhr.responseText);
                        let errorMessage = 'Terjadi kesalahan saat memperbarui status.';
                        try {
                            const errorResponse = JSON.parse(xhr.responseText);
                            if (errorResponse.message) {
                                errorMessage = errorResponse.message;
                            }
                            if (errorResponse.errors) {
                                for (const key in errorResponse.errors) {
                                    errorMessage += `\n${key}: ${errorResponse.errors[key].join(', ')}`;
                                }
                            }
                        } catch (e) {
                            // ignore
                        }
                        alert(errorMessage);
                    },
                    complete: function() {
                        form.find('button[type="submit"]').prop('disabled', false).text('Simpan');
                    }
                });
            });
        }

        fetchData(); // Panggil fetchData saat halaman pertama kali dimuat

        // Event listener untuk perubahan tab, agar fetchData dipanggil kembali
        // untuk memastikan data terbaru (terutama setelah update status)
        $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
            fetchData();
        });
    });
</script>
@endpush