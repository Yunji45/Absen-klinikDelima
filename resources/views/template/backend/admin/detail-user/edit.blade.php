@extends('template.layout.app.main')

@section('tabel')
<section class="section">
          <div class="section-header">
            <h1> Edit {{$title}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">{{$title}}</a></div>
              <div class="breadcrumb-item">Edit {{$title}} Forms</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Edit {{$title}} Forms</h2>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form action="{{route('detail.update.admin',$data->id)}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control @error('bulan') is-invalid @enderror" value="{{ old('name', $data->name) }}">
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Pendidikan</label>
                            <div class="col-sm-9">
                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="education" id="education">
                                <option value="{{$data->education}}">{{$data->education}}</option>
                                    <option value="S2">S2</option>
                                    <option value="S1 Kesehatan">S1 Kesehatan</option>
                                    <option value="S1 Non Kesehatan">S1 Non Kesehatan</option>
                                    <option value="D3 Kesehatan">D3 Kesehatan</option>
                                    <option value="D3 Non Kesehatan">D3 Non Kesehatan</option>
                                    <option value="SLTA Kesehatan">SLTA Kesehatan</option>
                                    <option value="SLTA Non Kesehatan">SLTA Non Kesehatan</option>
                                    <option value="Dibawah SLTA">Dibawah SLTA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Jabatan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pendidikan') is-invalid @enderror" name="position" id="position">
                                    <option value="{{$data->position}}">{{$data->position}}</option>
                                    <option value="DOKTER">Dokter</option>
                                    <option value="PERAWAT">Perawat</option>
                                    <option value="BIDAN">Bidan</option>
                                    <option value="APOTEKER">Apoteker</option>
                                    <option value="Ast.APOTEKER">Ast.Apoteker</option>
                                    <option value="ANALYS LAB">Analys LAB</option>
                                    <option value="NUTRISIONIS">Nutrisionis</option>
                                    <option value="ADMINISTRASI">Administrasi</option>
                                    <option value="UMUM">Umum</option>
                                    <option value="RUMAH TANGGA">Rumah Tangga</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Status Kepegawaian</label>
                            <div class="col-sm-9">
                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="status_pekerjaan" id="status_pekerjaan">
                                    <option value="{{$data->status_pekerjaan}}">{{$data->status_pekerjaan}}</option>
                                    <option value="TETAP">Tetap</option>
                                    <option value="KONTRAK">Kontrak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Mulai Bekerja</label>
                            <div class="col-sm-9">
                                <input type="date" name="hire_date" id="hire_date" class="form-control @error('hire_date') is-invalid @enderror" value="{{ old('hire_date', $data->hire_date) }}">
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Akhir Bekerja</label>
                            <div class="col-sm-9">
                                <input type="date" name="exit_date" id="exit_date" class="form-control @error('exit_date') is-invalid @enderror" value="{{ old('exit_date', $data->exit_date) }}">
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Alasan</label>
                            <div class="col-sm-9">
                                <input type="text" name="exit_reason" id="exit_reason" class="form-control @error('exit_reason') is-invalid @enderror" value="{{ old('exit_reason', $data->exit_reason) }}">
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="{{route('detail.pegawai.admin')}}" type="button" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection