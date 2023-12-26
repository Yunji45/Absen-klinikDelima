@extends('template.layout.app.main')

@section('tabel')
<section class="section">
          <div class="section-header">
            <h1>{{$title}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">{{$title}}</a></div>
              <div class="breadcrumb-item">{{$title}} Forms</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">{{$title}} Forms</h2>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form action="{{route('daftar.pasien.update',$pasien->id)}}" method="post">
                        @csrf
                            
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror" value="{{ old('bulan', $pasien->bulan) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">No RM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="No_RM" id="No_RM" class="form-control @error('name') is-invalid @enderror" value="{{ old('No_RM', $pasien->No_RM) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control @error('name') is-invalid @enderror" value="{{ old('nama_pasien', $pasien->nama_pasien) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="{{$pasien->jenis_kelamin}}">{{$pasien->jenis_kelamin}}</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="alamat" class="col-form-label col-sm-3">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat"> {{ old('alamat', $pasien->alamat) }}</textarea>
                                    @error('alamat') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <div class="modal-footer">
                            <a href="{{route('daftar.pasien')}}" type="button" class="btn btn-danger">Batal</a>
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