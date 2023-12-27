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
                    <form action="{{route('daftar.tugas.update',$tugas->id)}}" method="post">
                        @csrf
                            
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror" value="{{ old('bulan', $tugas->bulan) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Petugas</label>
                                <div class="col-sm-9">
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="{{$tugas->user_id}}" >{{$tugas->user->name}}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <select name="pasien_id" id="pasien_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="{{$tugas->pasien_id}}" >{{$tugas->pasien->nama_pasien}}</option>
                                        @foreach ($pasien as $pasiens)
                                            <option value="{{ $pasiens->id }}">{{ $pasiens->nama_pasien }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Jenis Layanan</label>
                                <div class="col-sm-9">
                                    <select name="layanan_id" id="layanan_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="{{$tugas->layanan_id}}" >{{$tugas->medis->jenis_layanan}}</option>
                                        @foreach ($kategori as $kategoris)
                                            <option value="{{ $kategoris->id }}">{{ $kategoris->jenis_layanan }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <div class="modal-footer">
                            <a href="{{route('daftar.tugas')}}" type="button" class="btn btn-danger">Batal</a>
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