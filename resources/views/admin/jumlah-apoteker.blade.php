@extends('footerheader.navbar')

@section('content')
    <div class="container mt-3">
        <h2>JUMLAH APOTEKER</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form id="searchForm" method="GET" onsubmit="fetchData(event)">
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Apoteker" name="search" id="searchInput" autocomplete="off">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
                    </button>
                </div>
            </form>

            <a type="button" class="btn btn-resep mb-3 px-4 py-3" href="{{ route('tambah-apoteker') }}">
                + Tambah Apoteker
            </a>
        </div>

        <!-- Tabel Data Apoteker -->
        <div class="card p-4 table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th style="width:250px">Username</th>
                        <th style="width:250px">Nama Apoteker</th>
                        <th style="width:400px">Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="apotekerTableBody">
                    <!-- Data apoteker akan dimuat disini melalui AJAX -->
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="paginate d-flex justify-content-center" id="pagination"></div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Edit Apoteker Modal -->
    <div class="modal fade" id="editApotekerModal" tabindex="-1" aria-labelledby="editApotekerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editApotekerModalLabel">Edit Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editApotekerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Username -->
                        <div class="row mb-3">
                            <label for="usernameEdit" class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="usernameEdit" name="username" required>
                            </div>
                        </div>

                        <!-- Nama Apoteker -->
                        <div class="row mb-3">
                            <label for="namaApotekerEdit" class="col-md-4 col-form-label">Nama Apoteker</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="namaApotekerEdit" name="nama_apoteker" required>
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
    <!-- Hapus Apoteker Modal -->
    <div class="modal fade" id="hapusApotekerModal" tabindex="-1" aria-labelledby="hapusApotekerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusApotekerModalLabel">Hapus Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <p>Anda yakin ingin menghapus apoteker ini?</p>
                    <form id="deleteApotekerForm" method="POST">
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
    // Fungsi untuk membuka modal dan mengisi form dengan data apoteker
    function openEditApotekerModal(id) {
        const row = document.getElementById("row" + id);
        const username = row.querySelector(".username").innerText;
        const nama_apoteker = row.querySelector(".nama_apoteker").innerText;
        
        // Masukkan data ke dalam modal
        document.getElementById("usernameEdit").value = username;
        document.getElementById("namaApotekerEdit").value = nama_apoteker;

        // Set form action URL dengan ID apoteker untuk update
        document.getElementById("editApotekerForm").action = `/api/admin/apoteker/update/${id}`;

        // Tampilkan modal
        $('#editApotekerModal').modal('show');
    }

    function openDeleteModal(id, username) {
        // Menampilkan data di dalam modal konfirmasi
        $('#hapusApotekerModal').modal('show');

        // Mengatur action form untuk menghapus apoteker berdasarkan ID
        $('#deleteApotekerForm').attr('action', `/api/admin/apoteker/delete/${id}`);
    }

    // Handle form submit penghapusan dengan AJAX
    $('#deleteApotekerForm').submit(function(e) {
        e.preventDefault(); // Mencegah form submit default

        const formData = new FormData(this); // Ambil semua data dari form

        const apotekerId = formData.get('id');  // Mendapatkan ID apoteker yang ingin dihapus

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
                    // Hapus baris apoteker dari tabel
                    $(`#row${apotekerId}`).remove();  // Menghapus baris tabel dengan ID apoteker
                    $('#hapusApotekerModal').modal('hide');  // Menutup modal
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
    $('#editApotekerForm').submit(function(e) {
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
                    $('#editApotekerModal').modal('hide');
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
    
    // Fetch Data Apoteker dengan AJAX
    function fetchData(event) {
        event?.preventDefault(); // Cegah form submit default jika pencarian digunakan
        
        const search = $('#searchInput').val();
        
        $.ajax({
            url: '/api/admin/apoteker/get',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                const apotekerData = response.data.data;
                const pagination = response.data; // Mengambil informasi pagination
                
                // Menampilkan data di tabel
                let tableBody = $('#apotekerTableBody');
                tableBody.empty();  // Menghapus data lama
                
                apotekerData.forEach((item, index) => {
                    tableBody.append(`
                        <tr id="row${item.id_apoteker}">
                            <td>${pagination.current_page * (index + 1) - (pagination.current_page - 1)}</td>
                            <td class="username">${item.username}</td>
                            <td class="nama_apoteker">${item.nama_apoteker}</td>
                            <td class="email">${item.email}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-success editPasien p-2 px-3 mx-2" onclick="openEditApotekerModal(${item.id_apoteker})">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" onclick="openDeleteModal(${item.id_apoteker}, '${item.username}')">
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
            url: '/api/admin/apoteker/get',
            type: 'GET',
            data: { search: search, page: page },
            success: function(response) {
                const apotekerData = response.data.data;
                const pagination = response.data; // Mengambil informasi pagination
                
                // Menampilkan data di tabel
                let tableBody = $('#apotekerTableBody');
                tableBody.empty();  // Menghapus data lama
                
                apotekerData.forEach((item, index) => {
                    const rowNumber = pagination.from + index;
                    tableBody.append(`
                        <tr id="row${item.id_apoteker}">
                            <td>${rowNumber}</td>
                            <td class="username">${item.username}</td>
                            <td class="nama_apoteker">${item.nama_apoteker}</td>
                            <td class="email">${item.email}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-success editPasien p-2 px-3 mx-2" onclick="openEditApotekerModal(${item.id_apoteker})">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" data-bs-toggle="modal" data-bs-target="#hapusApotekerModal${item.id_apoteker}">
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
