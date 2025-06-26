@extends('footerheader.navbar')

@section('content')
    <div class="container mt-3">
        <h2>JUMLAH RESEPSIONIS</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form id="searchForm" method="GET" onsubmit="fetchData(event)">
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Resepsionis" name="search" id="searchInput" autocomplete="off">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
                    </button>
                </div>
            </form>

            <a type="button" class="btn btn-resep mb-3 px-4 py-3" href="{{ route('tambah-resepsionis') }}">
                + Tambah Resepsionis
            </a>
        </div>

        <!-- Tabel Data resepsionis -->
        <div class="card p-4 table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th style="width:250px">Username</th>
                        <th style="width:250px">Nama Resepsionis</th>
                        <th style="width:400px">Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="resepsionisTableBody">
                    <!-- Data resepsionis akan dimuat disini melalui AJAX -->
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="paginate d-flex justify-content-center" id="pagination"></div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Edit resepsionis Modal -->
    <div class="modal fade" id="editresepsionisModal" tabindex="-1" aria-labelledby="editresepsionisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editresepsionisModalLabel">Edit Resepsionis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editresepsionisForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Username -->
                        <div class="row mb-3">
                            <label for="usernameEdit" class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="usernameEdit" name="username" required>
                            </div>
                        </div>

                        <!-- Nama resepsionis -->
                        <div class="row mb-3">
                            <label for="namaresepsionisEdit" class="col-md-4 col-form-label">Nama resepsionis</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="namaresepsionisEdit" name="nama_resepsionis" required>
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
    <!-- Hapus resepsionis Modal -->
    <div class="modal fade" id="hapusresepsionisModal" tabindex="-1" aria-labelledby="hapusresepsionisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusresepsionisModalLabel">Hapus Resepsionis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <p>Anda yakin ingin menghapus resepsionis ini?</p>
                    <form id="deleteresepsionisForm" method="POST">
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

@push('scripts')
    <script>
    // Fungsi untuk membuka modal dan mengisi form dengan data resepsionis
    function openEditresepsionisModal(id) {
        const row = document.getElementById("row" + id);
        const username = row.querySelector(".username").innerText;
        const nama_resepsionis = row.querySelector(".nama_resepsionis").innerText;
        
        // Masukkan data ke dalam modal
        document.getElementById("usernameEdit").value = username;
        document.getElementById("namaresepsionisEdit").value = nama_resepsionis;

        // Set form action URL dengan ID resepsionis untuk update
        document.getElementById("editresepsionisForm").action = `/api/admin/resepsionis/update/${id}`;

        // Tampilkan modal
        $('#editresepsionisModal').modal('show');
    }

    function openDeleteModal(id, username) {
        // Menampilkan data di dalam modal konfirmasi
        $('#hapusresepsionisModal').modal('show');

        // Mengatur action form untuk menghapus resepsionis berdasarkan ID
        $('#deleteresepsionisForm').attr('action', `/api/admin/resepsionis/delete/${id}`);
    }

    // Handle form submit penghapusan dengan AJAX
    $('#deleteresepsionisForm').submit(function(e) {
        e.preventDefault(); // Mencegah form submit default

        const formData = new FormData(this); // Ambil semua data dari form

        const resepsionisId = formData.get('id');  // Mendapatkan ID resepsionis yang ingin dihapus

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
                    // Hapus baris resepsionis dari tabel
                    $(`#row${resepsionisId}`).remove();  // Menghapus baris tabel dengan ID resepsionis
                    $('#hapusresepsionisModal').modal('hide');  // Menutup modal
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
    $('#editresepsionisForm').submit(function(e) {
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
                    $('#editresepsionisModal').modal('hide');
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
    
// --- FUNGSI UTAMA UNTUK MENGAMBIL DATA ---
        function fetchData(page = 1) {
            const search = $('#searchInput').val();

            $.ajax({
                url: '{{ route('api.get.resepsionis') }}', // Gunakan helper route() agar lebih aman
                type: 'GET',
                data: {
                    search: search,
                    page: page
                },
                success: function(response) {
                    const resepsionisData = response.data.data;
                    const pagination = response.data;

                    let tableBody = $('#resepsionisTableBody');
                    tableBody.empty(); // Kosongkan tabel sebelum diisi data baru

                    if (resepsionisData.length === 0) {
                        tableBody.append('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                    } else {
                        resepsionisData.forEach((item, index) => {
                            // Menghitung nomor urut dengan benar berdasarkan halaman
                            const rowNumber = (pagination.current_page - 1) * pagination.per_page + index + 1;
                            tableBody.append(`
                                <tr id="row${item.id_resepsionis}">
                                    <td>${rowNumber}</td>
                                    <td class="username">${item.username}</td>
                                    <td class="nama_resepsionis">${item.nama_resepsionis}</td>
                                    <td class="email">${item.email}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-success editPasien p-2 px-3 mx-2" onclick="openEditresepsionisModal(${item.id_resepsionis})">
                                            <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                        </button>
                                        <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" onclick="openDeleteModal(${item.id_resepsionis}, '${item.username}')">
                                            <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    }

                    // --- Handle Pagination ---
                    let paginationHtml = '';
                    if (pagination.last_page > 1) {
                        paginationHtml = `<ul class="pagination">`;
                        // Tombol Previous
                        paginationHtml += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
                            <a class="page-link" href="#" onclick="event.preventDefault(); fetchData(${pagination.current_page - 1})">Previous</a>
                        </li>`;

                        for (let i = 1; i <= pagination.last_page; i++) {
                            paginationHtml += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                                <a class="page-link" href="#" onclick="event.preventDefault(); fetchData(${i})">${i}</a>
                            </li>`;
                        }
                        // Tombol Next
                        paginationHtml += `<li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
                            <a class="page-link" href="#" onclick="event.preventDefault(); fetchData(${pagination.current_page + 1})">Next</a>
                        </li>`;
                        paginationHtml += `</ul>`;
                    }
                    $('#pagination').html(paginationHtml);
                },
                error: function(xhr) {
                    alert("Gagal memuat data. Silakan coba lagi.");
                    console.error("Error fetching data:", xhr.responseText);
                }
            });
        }
    // Initial fetch data
    fetchData();
</script>
@endpush


@endsection
