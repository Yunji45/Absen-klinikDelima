@extends('template.layout.app.main')
@section('tabel')
<section class="section">
  <div class="section-header">
    <h1>KPI Achievement Objectives</h1>
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
            <form method="post" action="{{ route('kpi.form.update',$realisasi->id) }}">
              @csrf
                  <div class="form-group col-md-7 col-12">
                      <label for="user_id" class="col-form-label col-sm-3">Nama Pegawai</label>
                      <div class="col-sm-8">
                          <select id="user_id" name="user_id" class="form-control">
                                  <option value="{{$realisasi->user_id}}">{{$realisasi->user->name}}</option>
                                  @foreach($user as $item)
                                  <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                          </select>
                              @error('user_id')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <!-- <div class="form-group col-md-7 col-12">
                      <label for="user_id" class="col-form-label col-sm-3">Nama Pegawai</label>
                      <div class="col-sm-8">
                          <select
                              class="form-control @error('user_id') is-invalid @enderror"
                              name="user_id"
                              id="user_id">
                              <option value="">pilih</option>
                              @foreach($user as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                          </select>
                          @error('user_id')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div> -->
                  <div class="form-group col-md-7 col-12">
                      <label for="user_id" class="col-form-label col-sm-3">Nama Target</label>
                      <div class="col-sm-8">
                          <select
                              class="form-control @error('user_id') is-invalid @enderror"
                              name="target_id"
                              id="target_id">
                              <option value="{{$realisasi->target_id}}">{{$targetId}}</option>
                              @foreach($ach as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                          </select>
                          @error('user_id')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group col-md-5 col-12">
                      <label for="div" class="col-form-label col-sm-6">Periode</label>
                      <div class="col-sm-12" >
                      <input type="text" name="bulan" id="bulan" value="{{ old('bulan', $realisasi->bulan) }}" class="form-control datepicker @error('bulan') is-invalid @enderror">
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
                  <th class="text-center">REALISASI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>A.</strong></td>
                  <td><strong style="text-decoration: underline;">Capaian Target</strong></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Pendaftaran</td>
                  <td class="text-center">{{$target->daftar}}</td>
                  <td class="text-center"><input type="number" name="r_daftar" id="r_daftar" value="{{ old('r_daftar', $realisasi->r_daftar) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Pemerikasaan Poli</td>
                  <td class="text-center">{{$target->poli}}</td>
                  <td class="text-center"><input type="number" name="r_poli"id="r_poli" value="{{ old('r_poli', $realisasi->r_poli) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Farmasi</td>
                  <td class="text-center">{{$target->farmasi}}</td>
                  <td class="text-center"><input type="number" name="r_farmasi" value="{{ old('r_farmasi', $realisasi->r_farmasi) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Kasir</td>
                  <td class="text-center">{{$target->kasir}}</td>
                  <td class="text-center"><input type="number" name="r_kasir" value="{{ old('r_kasir', $realisasi->r_kasir) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">5.</td>
                  <td class="text-center">Home Care</td>
                  <td class="text-center">{{$target->care}}</td>
                  <td class="text-center"><input type="number" name="r_care" value="{{ old('r_care', $realisasi->r_care) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">6.</td>
                  <td class="text-center">BPJS</td>
                  <td class="text-center">{{$target->bpjs}}</td>
                  <td class="text-center"><input type="number" name="r_bpjs" value="{{ old('r_bpjs', $realisasi->r_bpjs) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">7.</td>
                  <td class="text-center">Khitanan</td>
                  <td class="text-center">{{$target->khitan}}</td>
                  <td class="text-center"><input type="number" name="r_khitan" value="{{ old('r_khitan', $realisasi->r_khitan) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">8.</td>
                  <td class="text-center">Rawat Inap</td>
                  <td class="text-center">{{$target->rawat}}</td>
                  <td class="text-center"><input type="number" name="r_rawat" value="{{ old('r_rawat', $realisasi->r_rawat) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">9.</td>
                  <td class="text-center">Persalinan</td>
                  <td class="text-center">{{$target->salin}}</td>
                  <td class="text-center"><input type="number" name="r_salin" value="{{ old('r_salin', $realisasi->r_salin) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">10.</td>
                  <td class="text-center">Laboratorium</td>
                  <td class="text-center">{{$target->lab}}</td>
                  <td class="text-center"><input type="number" name="r_lab" value="{{ old('r_lab', $realisasi->r_lab) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">11.</td>
                  <td class="text-center">Umum</td>
                  <td class="text-center">{{$target->umum}}</td>
                  <td class="text-center"><input type="number" name="r_umum" value="{{ old('r_umum', $realisasi->r_umum) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">12.</td>
                  <td class="text-center">Visite Dokter</td>
                  <td class="text-center">{{$target->visit}}</td>
                  <td class="text-center"><input type="number" name="r_visit" value="{{ old('r_visit', $realisasi->r_visit) }}"></td>
                </tr>
                <tr>
                  <td class="text-center">12.</td>
                  <td class="text-center">USG</td>
                  <td class="text-center">0</td>
                  <td class="text-center"><input type="number" name="usg" value="{{ old('usg', $realisasi->usg) }}"></td>
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
