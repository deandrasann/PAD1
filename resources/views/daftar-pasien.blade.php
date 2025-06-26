@extends('footerheader.navbar')
@section('content')
    <div class="container">
        <h2 class="me-4">DATA PASIEN</h2>

        <!-- Search + Tambah Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Search Bar -->
            <form id="searchPasienForm" method="GET"> {{-- Memberi ID pada form search --}}
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Pasien" id="searchPasienInput" name="search"
                        value="{{ request('search') }}"> {{-- Memberi ID pada input search --}}
                    <button class="btn btn-link" type="submit" id="searchPasienButton"> {{-- Memberi ID pada tombol search --}}
                        <img src="{{ asset('images/search icon.png') }}">
                    </button>
                </div>
            </form>
            @can('resepsionis')
                <button type="button" class="btn btn-resep mb-3 px-4 py-3" data-bs-toggle="modal"
                    data-bs-target="#tambahPasienModal">
                    + Tambah Pasien
                </button>
            @endcan
        </div>

        <!-- Table Card -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="pasienTable"> {{-- Memberi ID pada tabel --}}
                    <thead class="table-primary">
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pasienTableBody"> {{-- Memberi ID pada tbody untuk diisi dinamis --}}
                        {{-- Data pasien akan dimuat di sini oleh AJAX --}}
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="paginate d-flex justify-content-center mt-3" id="paginationLinks"> {{-- Memberi ID pada div pagination --}}
                {{-- Link paginasi akan dimuat di sini oleh AJAX --}}
            </div>
        </div>
    </div>

    <!-- Tambah Pasien Modal -->
    <div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPasienModalLabel">Tambah Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahPasienForm" method="POST" enctype="multipart/form-data"> {{-- Memberi ID pada form dan pastikan enctype --}}
                    @csrf
                    <div class="modal-body">
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                                required>
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div>
                        <!-- Nama Pasien -->
                        <div class="mb-3">
                            <label for="namaPasien" class="form-label">Nama Pasien</label>
                            <input type="text" required class="form-control" name="nama" id="namaPasien"
                                placeholder="Nama pasien">
                        </div>
                        <!-- Tempat Lahir -->
                        <div class="mb-3">
                            <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                            <input type="text" required class="form-control" id="tempatLahir" name="tempat_lahir"
                                placeholder="Tempat Lahir">
                        </div>
                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" required class="form-control" id="tanggalLahir" name="tanggal_lahir">
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenisKelamin" name="jenis_kelamin" required>
                                <option value="" selected disabled>Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" required class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat pasien">
                        </div>
                        <!-- Provinsi -->
                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" required class="form-control" id="provinsi" name="provinsi"
                                placeholder="Provinsi">
                        </div>
                        <!-- Kabupaten -->
                        <div class="mb-3">
                            <label for="kabupaten" class="form-label">Kabupaten</label>
                            <input type="text" required class="form-control" id="kabupaten" name="kabupaten"
                                placeholder="Kabupaten">
                        </div>
                        <!-- Kecamatan -->
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" required class="form-control" id="kecamatan" name="kecamatan"
                                placeholder="Kecamatan">
                        </div>
                        <!-- Kelurahan -->
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" required class="form-control" id="kelurahan" name="kelurahan"
                                placeholder="Kelurahan">
                        </div>
                        <!-- No Telp -->
                        <div class="mb-3">
                            <label for="noTelp" class="form-label">No Telp</label>
                            <input type="number" required class="form-control" id="noTelp" name="no_telp"
                                placeholder="No telp pasien">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Pasien Modal -->
    <div class="modal fade" id="detailPasienModal" tabindex="-1" aria-labelledby="detailPasienModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPasienModalLabel">Detail Data Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img id="modalFoto" src="{{ asset('avatars/noimage.png') }}"
                                class="img-fluid rounded-circle mb-3" alt="Foto Pasien"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Username</th>
                                        <td id="modalUsername"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="modalEmail"></td>
                                    </tr>
                                    <tr>
                                        <th>No RM</th>
                                        <td id="modalNoRm"></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pasien</th>
                                        <td id="modalNamaPasien"></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td id="modalTempatLahir"></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td id="modalTanggalLahir"></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td id="modalJenisKelamin"></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td id="modalAlamat"></td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td id="modalProvinsi"></td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten</th>
                                        <td id="modalKabupaten"></td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td id="modalKecamatan"></td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan</th>
                                        <td id="modalKelurahan"></td>
                                    </tr>
                                    <tr>
                                        <th>No Telpon</th>
                                        <td id="modalNoTelp"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-resep" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Pasien Modal --}}
    <div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="editPasienModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasienModalLabel">Edit Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditPasien" method="POST" enctype="multipart/form-data"> {{-- ID form dan enctype --}}
                    @csrf
                    @method('PUT') {{-- Menggunakan method PUT/PATCH untuk update --}}
                    <div class="modal-body">
                        <!-- ID Pasien (Hidden, untuk referensi) -->
                        <input type="hidden" id="edit_id_pasien" name="id_pasien">
                        <!-- ID Pengguna (Hidden, untuk referensi User) -->
                        <input type="hidden" id="edit_id_pengguna" name="id_pengguna">

                        <div class="row mb-3">
                            <label for="edit_username" class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_username" name="username">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="edit_email" name="email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_password" class="col-md-4 col-form-label">Password (Kosongkan jika tidak
                                diubah)</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="edit_password" name="password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_foto" class="col-md-4 col-form-label">Foto Profil</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" id="edit_foto" name="foto"
                                    accept="image/*">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_no_rm" class="col-md-4 col-form-label">No RM</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_no_rm" name="no_rm" disabled>
                                {{-- No RM biasanya tidak bisa diubah --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_nama" class="col-md-4 col-form-label">Nama Pasien</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_nama" name="nama">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_tempat_lahir" class="col-md-4 col-form-label">Tempat Lahir</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_tempat_lahir" name="tempat_lahir">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_tanggal_lahir" class="col-md-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <select class="form-select" id="edit_jenis_kelamin" name="jenis_kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_alamat" class="col-md-4 col-form-label">Alamat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_alamat" name="alamat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_provinsi" class="col-md-4 col-form-label">Provinsi</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_provinsi" name="provinsi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_kabupaten" class="col-md-4 col-form-label">Kabupaten</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_kabupaten" name="kabupaten">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_kecamatan" class="col-md-4 col-form-label">Kecamatan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_kecamatan" name="kecamatan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_kelurahan" class="col-md-4 col-form-label">Kelurahan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_kelurahan" name="kelurahan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="edit_no_telp" class="col-md-4 col-form-label">No Telepon</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="edit_no_telp" name="no_telp">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-resep ms-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Global Delete Pasien Modal --}}
    <div class="modal fade" id="hapusPasienModalGlobal" tabindex="-1" aria-labelledby="hapusPasienModalGlobalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusPasienModalGlobalLabel">Hapus Data Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <p>Anda yakin ingin menghapus data pasien ini?</p>
                    <form action="" method="POST" id="deletePasienFormGlobal"> {{-- ID form global --}}
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                            <button type="submit" class="btn btn-danger px-4">YA</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.authCan = {
            resepsionis: @can('resepsionis')
                true
            @else
                false
            @endcan
        };
    </script>
    <script>
        $(document).ready(function() {
            // Function to fetch and display patient data
            function fetchPasienData(page = 1, searchQuery = '') {
                $.ajax({
                    // url: 'http://127.0.0.1:8000/api/pasien/get', debugging local
                    url: 'https://apotech.joesepdemar.site/api/pasien/get',
                    method: 'GET',
                    data: {
                        page: page,
                        search: searchQuery
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            let pasienData = response.data.data;
                            let html = '';
                            if (pasienData.length > 0) {
                                $.each(pasienData, function(index, item) {
                                    // Pastikan path foto benar, gunakan default jika kosong
                                    let fotoSrc = item.foto ? '{{ asset('storage/') }}/' + item
                                        .foto : '{{ asset('avatars/noimage.png') }}';

                                    let editDeleteButtons = '';
                                    if (window.authCan.resepsionis) {
                                        editDeleteButtons = `
                                        <!-- Edit Button -->
                                        <button class="btn btn-success btn-sm editPasien"
                                            data-id="${item.id_pasien}"
                                            data-idpengguna="${item.id_pengguna}"
                                            data-username="${item.username}"
                                            data-email="${item.email}"
                                            data-norm="${item.no_rm}"
                                            data-namapasien="${item.nama}"
                                            data-tempatlahir="${item.tempat_lahir}"
                                            data-tanggallahir="${item.tanggal_lahir}"
                                            data-jeniskelamin="${item.jenis_kelamin}"
                                            data-alamat="${item.alamat}"
                                            data-provinsi="${item.provinsi}"
                                            data-kabupaten="${item.kabupaten}"
                                            data-kecamatan="${item.kecamatan}"
                                            data-kelurahan="${item.kelurahan}"
                                            data-notelp="${item.no_telp}"
                                            data-foto="${fotoSrc}">
                                            <img src="{{ asset('images/edit icon.png') }}" class="me-1" alt="Edit">Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm delete-btn"
                                            data-id="${item.id_pasien}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusPasienModalGlobal">
                                            <img src="{{ asset('images/delete icon.png') }}" class="me-1" alt="Hapus">Hapus
                                        </button>
                                    `;
                                    }

                                    html += `
                                <tr>
                                    <td>${item.no_rm}</td>
                                    <td>${item.nama}</td>
                                    <td>${item.jenis_kelamin}</td>
                                    <td>${item.tanggal_lahir}</td>
                                    <td>${item.alamat}</td>
                                    <td>${item.no_telp}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <!-- Detail Button -->
                                            <button class="btn btn-resep btn-sm detail-btn"
                                                data-id="${item.id_pasien}"
                                                data-norm="${item.no_rm}"
                                                data-namapasien="${item.nama}"
                                                data-username="${item.username}"
                                                data-email="${item.email}"
                                                data-jenis="${item.jenis_kelamin}"
                                                data-tempatlahir="${item.tempat_lahir}"
                                                data-tanggallahir="${item.tanggal_lahir}"
                                                data-provinsi="${item.provinsi}"
                                                data-kabupaten="${item.kabupaten}"
                                                data-kecamatan="${item.kecamatan}"
                                                data-kelurahan="${item.kelurahan}"
                                                data-alamat="${item.alamat}"
                                                data-notelp="${item.no_telp}"
                                                data-foto="${fotoSrc}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailPasienModal">
                                                <img src="{{ asset('images/detail icon.png') }}" class="me-1" alt="Detail">Detail
                                            </button>
                                            ${editDeleteButtons}
                                        </div>
                                    </td>
                                </tr>
                                `;
                                });
                            } else {
                                html =
                                    `<tr><td colspan="7" class="text-center">Tidak Ada Data</td></tr>`;
                            }
                            $('#pasienTableBody').html(html);

                            // --- Generasi Pagination ---
                            let paginationHtml = '<ul class="pagination">';
                            $.each(response.data.links, function(index, link) {
                                let activeClass = link.active ? 'active' : '';
                                let disabledClass = link.url === null ? 'disabled' : '';
                                let pageNumber;

                                if (link.url) {
                                    const urlParams = new URLSearchParams(new URL(link.url)
                                        .search);
                                    pageNumber = urlParams.get('page');
                                } else {
                                    if (link.label.includes('Previous') && link.url === null) {
                                        pageNumber = 1;
                                    } else if (link.label.includes('Next') && link.url ===
                                        null) {
                                        pageNumber = response.data.last_page;
                                    } else {
                                        pageNumber = link.label;
                                    }
                                }

                                paginationHtml += `
                                <li class="page-item ${activeClass} ${disabledClass}">
                                    <a class="page-link" href="#" data-page="${pageNumber}">${link.label}</a>
                                </li>
                            `;
                            });
                            paginationHtml += '</ul>';
                            $('#paginationLinks').html(paginationHtml);

                            // Attach click event to pagination links (delegated)
                            $('#paginationLinks').off('click', '.page-link').on('click', '.page-link',
                                function(e) {
                                    e.preventDefault();
                                    const pageNum = $(this).data('page');
                                    const currentSearchQuery = $('#searchPasienInput').val();
                                    if (pageNum && !$(this).parent().hasClass('disabled')) {
                                        fetchPasienData(pageNum, currentSearchQuery);
                                    }
                                });

                        } else {
                            alert('Gagal mengambil data pasien: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            }

            // Initial load of data
            fetchPasienData();

            // Search functionality
            $('#searchPasienForm').on('submit', function(e) { // Listen for form submission
                e.preventDefault(); // Prevent default form submission
                let searchQuery = $('#searchPasienInput').val();
                fetchPasienData(1, searchQuery); // Reset to page 1 on new search
            });

            $('#searchPasienInput').on('keyup', function() {
                // Optional: Live search as user types
                // let searchQuery = $(this).val();
                // fetchPasienData(1, searchQuery);
            });

            // --- Detail Pasien Modal Script ---
            $(document).on('click', '.detail-btn', function() {
                $('#modalNoRm').text($(this).data('norm'));
                $('#modalNamaPasien').text($(this).data('namapasien'));
                $('#modalUsername').text($(this).data('username'));
                $('#modalEmail').text($(this).data('email'));
                $('#modalJenisKelamin').text($(this).data('jenis'));
                $('#modalTempatLahir').text($(this).data('tempatlahir'));
                $('#modalTanggalLahir').text($(this).data('tanggallahir'));
                $('#modalProvinsi').text($(this).data('provinsi'));
                $('#modalKabupaten').text($(this).data('kabupaten'));
                $('#modalKecamatan').text($(this).data('kecamatan'));
                $('#modalKelurahan').text($(this).data('kelurahan'));
                $('#modalAlamat').text($(this).data('alamat'));
                $('#modalNoTelp').text($(this).data('notelp'));

                var fotoSrc = $(this).data('foto');
                var modalFotoElement = $('#modalFoto');
                if (fotoSrc && fotoSrc !== '{{ asset('avatars/noimage.png') }}') {
                    modalFotoElement.attr('src', fotoSrc);
                } else {
                    modalFotoElement.attr('src', '{{ asset('avatars/noimage.png') }}');
                }
            });

            // --- Tambah Pasien Form Submission ---
            $('#tambahPasienForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this); // Gunakan FormData untuk upload file

                $.ajax({
                    url: '{{ route('api.pasien.create') }}',
                    method: 'POST',
                    data: formData,
                    processData: false, // Penting untuk FormData
                    contentType: false, // Penting untuk FormData
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#tambahPasienModal').modal('hide');
                            $('#tambahPasienForm')[0].reset(); // Clear form
                            fetchPasienData(); // Reload data
                        } else {
                            alert('Gagal menambah data pasien: ' + (response.message || JSON
                                .stringify(response.error)));
                            console.error('Error response:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status, error, xhr.responseText);
                        let errorMessage = 'Terjadi kesalahan saat menambah data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += '\n' + xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
            });

            // --- Edit Pasien Modal Handler ---
            $(document).on('click', '.editPasien', function() {
                const button = $(this); // Get the clicked button

                // Get data from data- attributes
                const id_pasien = button.data('id');
                const id_pengguna = button.data('idpengguna');
                const username = button.data('username');
                const email = button.data('email');
                const no_rm = button.data('norm');
                const nama = button.data('namapasien');
                const tempat_lahir = button.data('tempatlahir');
                const tanggal_lahir = button.data('tanggallahir');
                const jenis_kelamin = button.data('jeniskelamin');
                const alamat = button.data('alamat');
                const provinsi = button.data('provinsi');
                const kabupaten = button.data('kabupaten');
                const kecamatan = button.data('kecamatan');
                const kelurahan = button.data('kelurahan');
                const no_telp = button.data('notelp');
                // const foto = button.data('foto'); // Tidak langsung digunakan untuk mengatur input file, tapi bisa digunakan untuk menampilkan foto saat ini

                // Populate the form fields in the edit modal
                $('#edit_id_pasien').val(id_pasien);
                $('#edit_id_pengguna').val(id_pengguna);
                $('#edit_username').val(username);
                $('#edit_email').val(email);
                $('#edit_no_rm').val(no_rm); // Disabled, tapi tetap diisi untuk konsistensi
                $('#edit_nama').val(nama);
                $('#edit_tempat_lahir').val(tempat_lahir);
                $('#edit_tanggal_lahir').val(tanggal_lahir);
                $('#edit_jenis_kelamin').val(jenis_kelamin);
                $('#edit_alamat').val(alamat);
                $('#edit_provinsi').val(provinsi);
                $('#edit_kabupaten').val(kabupaten);
                $('#edit_kecamatan').val(kecamatan);
                $('#edit_kelurahan').val(kelurahan);
                $('#edit_no_telp').val(no_telp);
                $('#edit_password').val(''); // Kosongkan password untuk keamanan

                // Set action URL for the form
                $('#formEditPasien').attr('action', `/api/pasien/update/${id_pasien}`);

                // Show the modal
                $('#editPasienModal').modal('show');
            });

            // --- Edit Pasien Form Submission ---
            $('#formEditPasien').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let formData = new FormData(this); // Gunakan FormData untuk upload file

                // Tambahkan _method=PUT ke FormData untuk Laravel
                formData.append('_method', 'PUT');

                $.ajax({
                    url: url,
                    method: 'POST', // Gunakan POST karena FormData dan _method override
                    data: formData,
                    processData: false, // Penting untuk FormData
                    contentType: false, // Penting untuk FormData
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#editPasienModal').modal('hide');
                            fetchPasienData(); // Reload data
                        } else {
                            alert('Gagal mengupdate data pasien: ' + (response.message || JSON
                                .stringify(response.error)));
                            console.error('Error response:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status, error, xhr.responseText);
                        let errorMessage = 'Terjadi kesalahan saat mengupdate data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += '\n' + xhr.responseJSON.message;
                        } else if (error) {
                            errorMessage += '\n' + error;
                        }
                        alert(errorMessage);
                    }
                });
            });

            // --- Delete Pasien Modal Handler (global) ---
            $(document).on('click', '.delete-btn', function() {
                const id_pasien = $(this).data('id');
                // Set action URL for the global delete form
                $('#deletePasienFormGlobal').attr('action', `/api/pasien/delete/${id_pasien}`);
            });

            // --- Delete Pasien Form Submission (global) ---
            $('#deletePasienFormGlobal').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let token = $('input[name="_token"]', form).val(); // Ambil token dari form

                $.ajax({
                    url: url,
                    type: 'POST', // Selalu POST untuk method override
                    data: {
                        _token: token,
                        _method: 'DELETE' // Override method ke DELETE
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#hapusPasienModalGlobal').modal(
                            'hide'); // Sembunyikan modal global
                            fetchPasienData(); // Reload data
                        } else {
                            alert('Gagal menghapus data pasien: ' + (response.message ||
                                'Terjadi kesalahan.'));
                            console.error('Error response:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status, error, xhr.responseText);
                        let errorMessage = 'Terjadi kesalahan saat menghapus data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += '\n' + xhr.responseJSON.message;
                        } else if (error) {
                            errorMessage += '\n' + error;
                        }
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>
@endpush
