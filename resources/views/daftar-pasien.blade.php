@extends('footerheader.navbar')
@section('content')
<div class="container">
    <h2 class="me-4">DATA PASIEN</h2>
    <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
       <strong> + Tambah Pasien</strong>
    </button>

    <form action="{{ route('daftar-pasien') }}" method="GET">
    <div class="search-bar my-3">
        <input type="text" class="form-control" placeholder="Cari Obat" name="search" value="{{ request("search") }}" autocomplete="off">
        <button class="btn btn-link" type="submit">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>
    </form>

</div>

<div class="d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-2 py-2">No RM</th>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Jenis kelamin</th>
                    <th class="px-4 py-2">Tanggal Lahir</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">No Telp</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data_pasien as $index => $item)
                <tr>
                    <td>{{ $item->no_rm }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>
                        {{-- <button class="btn btn-resep p-2 px-3 detail-btn" data-bs-toggle="modal" data-bs-target="#detailPasienModal">
                            <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                        </button> --}}
                        <button class="btn btn-primary p-2 px-3 detail-btn" data-norm="{{ $item->no_rm }}"
                            data-nama="{{ $item->nama }}" data-jenis="{{ $item->jenis_kelamin }}"
                            data-tanggal="{{ $item->tanggal_lahir }}" data-alamat="{{ $item->alamat }}"
                            data-notelp="{{ $item->no_telp }}"
                            data-bs-toggle="modal" data-bs-target="#detailPasienModal">
                            <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                        </button>
                        
                        {{-- <button class="btn btn-success p-2 px-3 edit-btn" data-bs-toggle="modal" data-bs-target="#editPasienModal">
                            <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                        </button> --}}

                        <button class="btn btn-success editPasien p-2 px-3" onclick="openEditPasienModal({{$item->id_pasien}})" id="editPasien{{$item->id_pasien}}">
                            <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                            </button>

                        {{-- <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal" data-bs-target="#hapusPasienModal">
                            <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                        </button> --}}
                        <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal"
                        data-bs-target="#hapusPasienModal{{ $item->id_pasien }}">
                        <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                    </button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tambah Pasien Modal -->
        <div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPasienModalLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('pasien.store') }}" method="POST">
                        @csrf
                    <div class="modal-body">
                            <!-- Nama Pasien -->
                            <div class="mb-3">
                                <label for="norm" class="form-label">No RM</label>
                                <input type="numberrequired " class="form-control" id="norm" name="no_rm" placeholder="No RM" required>
                            </div>

                            <div class="mb-3">
                                <label for="namaPasien" class="form-label">Nama Pasien</label>
                                <input type="text" required class="form-control" name="nama" id="namaPasien" placeholder="Nama pasien">
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenisKelamin" name="jenis_kelamin" required>
                                    <option selected>Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" required class="form-control" id="tanggalLahir" name="tanggal_lahir">
                            </div>

                            <div class="mb-3">
                                <label for="beratbadan" class="form-label">Berat Badan Pasien</label>
                                <input type="text" required class="form-control" id="beratbadan" name="berat_badan" placeholder="Berat Badan Pasien">
                            </div>
                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" required class="form-control" id="alamat" name="alamat" placeholder="Alamat pasien">
                            </div>
                            <!-- No Telp -->
                            <div class="mb-3">
                                <label for="noTelp" class="form-label">No Telp</label>
                                <input type="text" required class="form-control" id="noTelp" name="no_telp" placeholder="No telp pasien">
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

        {{-- Detail Pasien --}}
        <div class="modal fade" id="detailPasienModal" tabindex="-1" aria-labelledby="detailPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailPasienModalLabel">Detail Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>No RM</th>
                                    <td id="modalnorm"></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td id="modalnama"></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td id="modaljenis"></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td id="modaltanggal"></td>
                                </tr>
                                <tr>
                                    <th>No telpon</th>
                                    <td id="modalnotelp"></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td id="modalalamat"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-resep" data-bs-dismiss="modal">Kembali</button>
                    </div>

                </div>
            </div>
        </div>
        
       

         {{-- Edit Obat Modal --}}
    <div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="editPasienModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editPasienModalLabel">Edit Pasien</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="formedit">
                @csrf
            <div class="modal-body">
                <form>
                  <!-- Nama Obat -->
                  <div class="row mb-3">
                    <label for="norm" class="col-md-4 col-form-label">No RM</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="nomorrm" name="no_rm" >
                    </div>
                  </div>

                  <!-- Bentuk Obat -->
                  <div class="row mb-3">
                    <label for="nama" class="col-md-4 col-form-label">Nama</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="nama" name="nama">                     
                    </div>
                  </div>

                  <!-- Kebutuhan Sediaan & Satuan -->
                  <div class="row mb-3">
                    <label for="tanggal" class="col-md-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="tanggal" name="tanggal_lahir">
                    </div>
                  </div>

                  <!-- Efek Samping -->
                  <div class="row mb-3">
                    <label for="jenis" class="col-md-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="jenis" name="jenis_kelamin">
                    </div>
                  </div>

                  <!-- Kontraindikasi -->
                  <div class="row mb-3">
                    <label for="notelp" class="col-md-4 col-form-label">No Telepon</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="notelp" name="no_telp">
                    </div>
                  </div>

                  <!-- Interaksi Obat -->
                  <div class="row mb-3">
                    <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="alamatedit" name="alamat">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-resep ms-auto">Simpan</button>
            </div>
        </div>
    </form>
        </div>
      </div>

      @foreach ($data_pasien as $key)
      <div class="modal fade" id="hapusPasienModal{{ $key->id_pasien }}" tabindex="-1" aria-labelledby="hapusPasienModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content ">
                  <div class="modal-header">
                      <h5 class="modal-title" id="hapusPasienModalLabel">Hapus Data Obat</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                      <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                      <p>Anda yakin ingin menghapus data obat ini?</p>
                      <form action="{{ route('pasien.destroy', $key->id_pasien)}}" method="POST">
                      <div class="d-flex justify-content-around mt-3">
                          <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger px-4">YA</button>
                      </div>
                  </div>
              </form>
              </div>
            </div>
        </div>
        @endforeach

        <!-- Pagination -->
        <div class="paginate d-flex justify-content-center">
            {{ $data_pasien->links() }}
        </div>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.detail-btn');

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const norm = this.getAttribute('data-norm');
                const nama = this.getAttribute('data-nama');
                const jenis = this.getAttribute('data-jenis');
                const tanggal = this.getAttribute('data-tanggal');
                const alamat = this.getAttribute('data-alamat');
                const notelp = this.getAttribute('data-notelp');

                // Mengisi data ke dalam modal
                document.getElementById('modalnorm').textContent = norm;
                document.getElementById('modalnama').textContent = nama;
                document.getElementById('modaljenis').textContent = jenis;
                document.getElementById('modaltanggal').textContent = tanggal;
                document.getElementById('modalalamat').textContent = alamat;
                document.getElementById('modalnotelp').textContent = notelp;
            });
        });
    });
</script>

<script>
    function openEditPasienModal(id) {
   // document.getElementById('editObatModal').style.visibility="true";
   $('#editPasienModal').modal('show');
   var editButton = document.getElementById("editPasien"+id);
   var row = editButton.closest("tr");
   var data = row.getElementsByTagName('td');

   document.getElementById("formedit").action = "{{route('pasien.update', '')}}/" + id;  
   document.getElementById("nomorrm").value = data[0].innerText;  
   document.getElementById("nama").value = data[1].innerText;  
   document.getElementById("tanggal").value = data[3].innerText;  
   document.getElementById("jenis").value = data[2].innerText;  
   document.getElementById("notelp").value = data[5].innerText;  
   document.getElementById("alamatedit").value = data[4].innerText;  
   // document.getElementById("editCategoryDescription").value = data[1].innerText;  
   // document.getElementById("editCategoryDescription").value = data[2].innerText;  
   // console.log(data);
   
 }
</script>