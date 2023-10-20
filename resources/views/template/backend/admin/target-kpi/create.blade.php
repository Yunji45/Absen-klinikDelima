@extends('template.layout.app.main')
@section('tabel')
<section class="section">
  <div class="section-header">
    <h1>Target KPI</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">{{$title}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{$title}}</h2>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <table class="table table-sm table-bordered table-white text-center">
            <form method="post" action="{{ route('target.kpi.save') }}">
              @csrf
              <div class="row">
                <div class="form-group col-md-5 col-12">
                      <label for="div" class="col-form-label col-sm-6">Nama Target</label>
                      <div class="col-sm-12" >
                      <input type="text" name="name" id="name" class="form-control @error('bulan') is-invalid @enderror">
                          @error('bulan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group col-md-5 col-12">
                      <label for="div" class="col-form-label col-sm-6">Start date</label>
                      <div class="col-sm-12" >
                      <input type="text" name="start_date" id="start_date" class="form-control datepicker @error('bulan') is-invalid @enderror">
                          @error('bulan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group col-md-5 col-12">
                      <label for="div" class="col-form-label col-sm-6">End date</label>
                      <div class="col-sm-12" >
                      <input type="end_date" name="end_date" id="bulan" class="form-control datepicker @error('bulan') is-invalid @enderror">
                          @error('bulan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

              </div>

              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">ASPEK KINERJA</th>
                  <th class="text-center">TARGET</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Pendaftaran</td>
                  <td class="text-center"><input type="number" name="daftar" id="daftar"></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Pemerikasaan Poli</td>
                  <td class="text-center"><input type="number" name="poli" id="poli"></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Farmasi</td>
                  <td class="text-center"><input type="number" name="farmasi" /></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Kasir</td>
                  <td class="text-center"><input type="number" name="kasir" /></td>
                </tr>
                <tr>
                  <td class="text-center">5.</td>
                  <td class="text-center">Home Care</td>
                  <td class="text-center"><input type="number" name="care" /></td>
                </tr>
                <tr>
                  <td class="text-center">6.</td>
                  <td class="text-center">BPJS</td>
                  <td class="text-center"><input type="number" name="bpjs" /></td>
                </tr>
                <tr>
                  <td class="text-center">7.</td>
                  <td class="text-center">Khitanan</td>
                  <td class="text-center"><input type="number" name="khitan" /></td>
                </tr>
                <tr>
                  <td class="text-center">8.</td>
                  <td class="text-center">Rawat Inap</td>
                  <td class="text-center"><input type="number" name="rawat" /></td>
                </tr>
                <tr>
                  <td class="text-center">9.</td>
                  <td class="text-center">Persalinan</td>
                  <td class="text-center"><input type="number" name="salin" /></td>
                </tr>
                <tr>
                  <td class="text-center">10.</td>
                  <td class="text-center">Laboratorium</td>
                  <td class="text-center"><input type="number" name="lab" /></td>
                </tr>
                <tr>
                  <td class="text-center">11.</td>
                  <td class="text-center">Umum</td>
                  <td class="text-center"><input type="number" name="umum" /></td>
                </tr>
                <tr>
                  <td class="text-center">12.</td>
                  <td class="text-center">Visite Dokter</td>
                  <td class="text-center"><input type="number" name="visit" /></td>
                </tr>
                <!-- Add more rows as needed -->
              </tbody>
            </table>
            <input type="submit" class="btn btn-success" value="Simpan Data">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
