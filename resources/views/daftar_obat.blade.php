@extends('footerheader.navbar')

@section('content')

<div class="container mt-4" st>
    <h2>DATA RESEP OBAT</h2>


    <div class="d-flex justify-content-between align-items-center">
        <div class="card my-4" style="width: 24rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-5"><strong>No Resep</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Tanggal Resep</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Nama </strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Jenis Kelamin</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>No Telepon</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Alamat</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
            </div>

          </div>
          <div class="modal fade modal-dialog modal-dialog-centered" id="cetakObat" tabindex="-1" aria-labelledby="cetakObatLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="cetakObatLabel">Pilih obat yang akan dicetak</h5>
                    </div>
                    <div>
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                          Select All
                        </label>
                    </div>



                </div>
                <div class="modal-body">
                    <div class="checkbox-group">

                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-resep ms-auto">Cetak</button>

                </div>
              </div>
            </div>
          </div>

          <a href="#" class="container-row-2 p-4" data-bs-toggle="modal" data-bs-target="#cetakObat">
            <img src="{{ asset('images/printer.png') }}">
          </a>
    </div>

    <button type="button" class="btn btn-resep tambah-obat-btn">
        <strong>+ Tambah Obat</strong>
    </button>

    <!-- Search Bar -->
    <div class="search-bar mb-3">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>

    <!-- Tabel Data Resep Obat -->
    <div class="table-data table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th style="width:250px">Indikasi</th>
                    <th style="width:250px">Golongan Obat</th>
                    <th style="width:400px">Nama Obat</th>
                    <th >Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_role }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <button class="btn btn-resep p-2 px-3 detail-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button>
                            <button class="btn btn-success p-2 px-3 edit-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Edit
                            </button>
                            <button class="btn btn-danger p-2 px-3 delete-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="paginate d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection
