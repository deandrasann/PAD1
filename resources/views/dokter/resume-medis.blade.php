@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav">
    <a class="nav-link" href="{{ route('resume-medis') }}">Isi Resume Medis</a>
    <a class="nav-link" href="{{ route('riwayat-konsultasi') }}">Riwayat Konsultasi</a>
</nav>

<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-borderless border">
            <thead>
                <tr>
                    <th class="bg-light" colspan="2">DATA KUNJUNGAN</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><strong>Jadwal</strong></td></tr>
                <tr><td>dr. Andi Junaidi</td></tr>
                <tr><td>Poli Umum</td></tr>
                <tr><td>Kunjungan sakit</td></tr>
                <tr><td>24/10/2024</td></tr>
            </tbody>
        </table>
    </div>
</div>


<div class="container">

    <div class="stepwizard col-md-offset-3">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-resep">1</a>
            <p>Pemeriksaan </p>
          </div>
          <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-light" disabled="disabled">2</a>
            <p>Assesment</p>
          </div>
          <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-light" disabled="disabled">3</a>
            <p class="px-4">Resep</p>
          </div>
        </div>
      </div>

      <form role="form" action="" method="post">
        <div class="row setup-content" id="step-1">
          <div class="col-xs-6 col-md-offset-3">
            <div class="col md-12">
                <div class="table-responsive">
                    <table class="table table-borderless border">
                        <thead>
                            <tr>
                                <th class="" colspan="2"><h4>DATA KESEHATAN</h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="my-2">Golongan Darah</label>
                                            <input type="text" class="form-control w-50">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="my-2">Merokok?</label><br>
                                            <div class="form-check form-check-inline ms-2">
                                                <input class="form-check-input" type="checkbox" id="merokokYa">
                                                <label class="form-check-label" for="merokokYa">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="merokokTidak">
                                                <label class="form-check-label" for="merokokTidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="my-2">Berat Badan</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mt-4 mb-2">Hamil / Menyusui</label><br>
                                            <div class="form-check form-check-inline ms-2">
                                                <input class="form-check-input" type="checkbox" id="hamil">
                                                <label class="form-check-label" for="hamil">Hamil</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="menyusui">
                                                <label class="form-check-label" for="menyusui">Menyusui</label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="my-2">Tinggi Badan</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <hr>
                            <tr>
                                <td colspan="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                            <h5>Keluhan</h5>
                                            <label class="my-2">Anamnesa</label>
                                            <div class="input-group w-100">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <hr>
                                    <h5 class="my-4">TANDA-TANDA VITAL</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="my-2">Suhu tubuh</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">C</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="my-2">Nadi</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">bpm</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="my-2">Sistole</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">mmhg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="my-2">Preferensi pernafasan</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">rpm</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="my-2">Tinggi Badan</label>
                                            <div class="input-group w-50">
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
              <button class="btn btn-resep nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
          </div>
        </div>
        <div class="row setup-content" id="step-2">
          <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                <table class="table table-borderless border">
                    <thead>
                        <tr>
                            <th class="mt-2" colspan="2"><h4>ASSESMENT</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                            <td colspan="1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="my-2">Diagnosa</label>
                                        <div class="input-group w-100 mb-4">
                                            <textarea type="text" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>
                <button class="btn btn-resep nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
          </div>
        </div>
        <div class="row setup-content" id="step-3">
          <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
              <table class="table table-borderless border">

                    <tbody>
                            <td colspan="1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="my-2">Resep</label>

                                        <hr>
                                        <button type="button" class="btn btn-resep px-2 py-2 mb-2 mt-4" data-bs-toggle="modal"
                                            data-bs-target="#tambahObatModal">
                                            <strong><a href="{{ route('tambah-obat-dokter') }}" style="color: white; text-decoration:none">+ Tambah Obat </a> </strong>
                                        </button>

                                        <div class="mb-4 mt-4">
                                            <label class="mb-2">Medikamentosa</label><br>
                                            <input type="text" class="form-control" placeholder="Paracetamol"></input>
                                        </div>
                                        <div class="mb-4 mt-4">
                                            <label class="mb-2">Non-Medikamentosa</label><br>
                                            <input type="text" class="form-control" placeholder="Anjuran untuk pasien"></input>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>
              <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
            </div>
          </div>
        </div>
      </form>

    </div>

    <script>
        $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-resep').addClass('btn-light');
          $item.addClass('btn-resep');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-resep').trigger('click');
});
    </script>


@endsection
