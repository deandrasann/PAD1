@extends('footerheader.navbar')

@section('content')
    <div class="container mt-3">
        <h2>JUMLAH DOKTER</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form id="searchForm" method="GET" onsubmit="fetchData(event)">
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Dokter" name="search" id="searchInput" autocomplete="off">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
                    </button>
                </div>
            </form>

            <a type="button" class="btn btn-resep mb-3 px-4 py-3" href="{{ route('tambah-dokter') }}">
                + Tambah Dokter
            </a>
        </div>

        <!-- Tabel Data dokter -->
        <div class="card p-4 table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th style="width:250px">Username</th>
                        <th style="width:250px">Nama Dokter</th>
                        <th style="width:400px">Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dokterTableBody">
                    <!-- Data dokter akan dimuat disini melalui AJAX -->
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="paginate d-flex justify-content-center" id="pagination"></div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Edit dokter Modal -->
    <div class="modal fade" id="editdokterModal" tabindex="-1" aria-labelledby="editdokterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editdokterModalLabel">Edit Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editdokterForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Username -->
                        <div class="row mb-3">
                            <label for="usernameEdit" class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="usernameEdit" name="username" required>
                            </div>
                        </div>

                        <!-- Nama dokter -->
                        <div class="row mb-3">
                            <label for="namadokterEdit" class="col-md-4 col-form-label">Nama Dokter</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="namadokterEdit" name="nama_dokter" required>
                            </div>
                        </div>

                        <!-- Jenis dokter -->
                        <div class="row mb-3">
                            <label for="jenisdokterEdit" class="col-md-4 col-form-label">Jenis Dokter</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="jenisdokterEdit" name="jenis_dokter" required>
                            </div>
                        </div>

                        <!-- Spesialis -->
                        <div class="row mb-3">
                            <label for="spesialisEdit" class="col-md-4 col-form-label">Spesialis</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="spesialisEdit" name="spesialis" required>
                            </div>
                        </div>

                        <!-- Kode dokter -->
                        <div class="row mb-3">
                            <label for="kodedokterEdit" class="col-md-4 col-form-label">Kode dokter</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="kodedokterEdit" name="kode_dokter" required>
                            </div>
                        </div>

                        <!-- Kode bpjs -->
                        <div class="row mb-3">
                            <label for="kodebpjsEdit" class="col-md-4 col-form-label">Kode bpjs</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="kodebpjsEdit" name="kode_bpjs" required>
                            </div>
                        </div>

                        <!-- Foto -->
                        <div class="row mb-3">
                            <label for="fotoEdit" class="col-md-4 col-form-label">Foto</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" id="fotoEdit" name="foto">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="passwordEdit" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="passwordEdit" name="password" placeholder="Password (opsional)">
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

    <!-- Modals -->
    <!-- Hapus dokter Modal -->
    <div class="modal fade" id="hapusdokterModal" tabindex="-1" aria-labelledby="hapusdokterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusdokterModalLabel">Hapus Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <p>Anda yakin ingin menghapus dokter ini?</p>
                    <form id="deletedokterForm" method="POST">
                        @csrf
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                            <button type="submit" class="btn btn-danger px-4">YA</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>
    // Fungsi untuk membuka modal dan mengisi form dengan data dokter
    function openEditdokterModal(id) {
        const row = document.getElementById("row" + id);
        const username = row.querySelector(".username").innerText;
        const nama_dokter = row.querySelector(".nama_dokter").innerText;
        const jenis_dokter = row.querySelector("input#jenis_dokter").value;
        const spesialis = row.querySelector("input#spesialis").value;
        const kode_dokter = row.querySelector("input#kode_dokter").value;
        const kode_bpjs = row.querySelector("input#kode_bpjs").value;
        
        // Masukkan data ke dalam modal
        document.getElementById("usernameEdit").value = username;
        document.getElementById("namadokterEdit").value = nama_dokter;
        document.getElementById("jenisdokterEdit").value = jenis_dokter;
        document.getElementById("spesialisEdit").value = spesialis;
        document.getElementById("kodedokterEdit").value = kode_dokter;
        document.getElementById("kodebpjsEdit").value = kode_bpjs;

        // Set form action URL dengan ID dokter untuk update
        document.getElementById("editdokterForm").action = `/api/admin/dokter/update/${id}`;

        // Tampilkan modal
        $('#editdokterModal').modal('show');
    }

    function openDeleteModal(id, username) {
        // Menampilkan data di dalam modal konfirmasi
        $('#hapusdokterModal').modal('show');

        // Mengatur action form untuk menghapus dokter berdasarkan ID
        $('#deletedokterForm').attr('action', `/api/admin/dokter/delete/${id}`);
    }

    // Handle form submit penghapusan dengan AJAX
    $('#deletedokterForm').submit(function(e) {
        e.preventDefault(); // Mencegah form submit default

        const formData = new FormData(this); // Ambil semua data dari form

        const dokterId = formData.get('id');  // Mendapatkan ID dokter yang ingin dihapus

        // foreach entries formData untuk debugging
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        $.ajax({
            url: $(this).attr('action'),  // URL DELETE API
            type: 'DELETE',
            data: formData,
            processData: false,
            contentType: false,
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Hapus baris dokter dari tabel
                    $(`#row${dokterId}`).remove();  // Menghapus baris tabel dengan ID dokter
                    $('#hapusdokterModal').modal('hide');  // Menutup modal
                    alert(response.message);  // Menampilkan pesan sukses
                    fetchData();  // Memuat ulang data setelah penghapusan
                }
            },
            error: function(xhr) {
                // Menampilkan pesan kesalahan jika ada
                alert("Terjadi kesalahan: " + xhr.responseJSON.message);
                console.log("Terjadi kesalahan: " + xhr.responseJSON.message)
            }
        });
    });

    // Handle form submit dengan AJAX
    $('#editdokterForm').submit(function(e) {
        e.preventDefault(); // Mencegah form melakukan submit default
        
        const formData = new FormData(this); // Ambil semua data dari form
        
        $.ajax({
            url: $(this).attr('action'),  // Menggunakan URL yang telah di-assign
            type: 'POST',  // Menggunakan POST, namun kita akan override menjadi PUT
            data: formData,
            processData: false, // Jangan mengubah data menjadi string
            contentType: false, // Jangan mengatur contentType, biarkan FormData yang mengaturnya
            headers: {
                'X-HTTP-Method-Override': 'PUT',  // Menggunakan header untuk memberitahukan Laravel bahwa ini PUT
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Sertakan CSRF Token di header
            },
            success: function(response) {
                alert(response.message);  // Menampilkan pesan sukses
                if (response.status === 'success') {
                    $('#editdokterModal').modal('hide');
                    fetchData();  // Memuat ulang data setelah update
                }
            },
            error: function(xhr) {
                let errorMessage = "Terjadi kesalahan saat memproses permintaan.";
    
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        errorMessage = "Perbaiki kesalahan berikut:\n";
                        const errors = xhr.responseJSON.errors;
                        
                        for (const field in errors) {
                            errorMessage += `\n- ${errors[field].join(', ')}`;
                        }
                    } else if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                }
                
                alert(errorMessage);
            }
        });
    });
    
    // Fetch Data dokter dengan AJAX
    function fetchData(event) {
        event?.preventDefault(); // Cegah form submit default jika pencarian digunakan
        
        const search = $('#searchInput').val();
        
        $.ajax({
            url: '/api/admin/dokter/get',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                const dokterData = response.data.data;
                const pagination = response.data; // Mengambil informasi pagination
                
                // Menampilkan data di tabel
                let tableBody = $('#dokterTableBody');
                tableBody.empty();  // Menghapus data lama
                
                dokterData.forEach((item, index) => {
                    tableBody.append(`
                        <tr id="row${item.id_dokter}">
                            <td>${pagination.current_page * (index + 1) - (pagination.current_page - 1)}</td>
                            <td class="username">${item.username}</td>
                            <td class="nama_dokter">${item.nama_dokter}</td>
                            <td class="email">${item.email}</td>
                            <input type="hidden" id="jenis_dokter" value="${item.jenis_dokter}">
                            <input type="hidden" id="spesialis" value="${item.spesialis}">
                            <input type="hidden" id="kode_dokter" value="${item.kode_dokter}">
                            <input type="hidden" id="kode_bpjs" value="${item.kode_bpjs}">
                            <td class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-success editPasien p-2 px-3 mx-2" onclick="openEditdokterModal(${item.id_dokter})">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" onclick="openDeleteModal(${item.id_dokter}, '${item.username}')">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                        </tr>
                    `);
                });

                // Handle Pagination
                let paginationHtml = `<ul class="pagination">`;
                for (let i = 1; i <= pagination.last_page; i++) {
                    paginationHtml += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                        <a class="page-link" href="javascript:void(0)" onclick="fetchDataPage(${i})">${i}</a>
                    </li>`;
                }
                paginationHtml += `</ul>`;
                $('#pagination').html(paginationHtml);
            }
        });
    }

    // Handle pagination clicks
    function fetchDataPage(page) {
        const search = $('#searchInput').val();

        $.ajax({
            url: '/api/admin/dokter/get',
            type: 'GET',
            data: { search: search, page: page },
            success: function(response) {
                const dokterData = response.data.data;
                const pagination = response.data; // Mengambil informasi pagination
                
                // Menampilkan data di tabel
                let tableBody = $('#dokterTableBody');
                tableBody.empty();  // Menghapus data lama
                
                dokterData.forEach((item, index) => {
                    tableBody.append(`
                        <tr id="row${item.id_dokter}">
                            <td>${pagination.current_page * (index + 1) - (pagination.current_page - 1)}</td>
                            <td class="username">${item.username}</td>
                            <td class="nama_dokter">${item.nama_dokter}</td>
                            <td class="email">${item.email}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-success editPasien p-2 px-3 mx-2" onclick="openEditdokterModal(${item.id_dokter})">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" data-bs-toggle="modal" data-bs-target="#hapusdokterModal${item.id_dokter}">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                        </tr>
                    `);
                });

                // Handle Pagination
                let paginationHtml = `<ul class="pagination">`;
                for (let i = 1; i <= pagination.last_page; i++) {
                    paginationHtml += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                        <a class="page-link" href="javascript:void(0)" onclick="fetchDataPage(${i})">${i}</a>
                    </li>`;
                }
                paginationHtml += `</ul>`;
                $('#pagination').html(paginationHtml);
            }
        });
    }

    // Initial fetch data
    fetchData();
</script>

@endsection
