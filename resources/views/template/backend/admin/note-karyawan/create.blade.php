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
                    <form action="{{route('note-karyawan.store')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="user_id" id="user_id">
                                    <option value="">Pilih Nama Karyawan</option>
                                    @foreach($user as $users)
                                    <option value="{{$users->id}}">{{$users->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Keterangan Catatan</label>
                            <div class="col-sm-9">
                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="keterangan" id="keterangan">
                                    <option value="">Pilih Keterangan</option>
                                    <option value="Positif">Positif</option>
                                    <option value="Negatif">Negatif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Waktu</label>
                            <div class="col-sm-9">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('hire_date') is-invalid @enderror" >
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-form-label col-sm-3">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4"></textarea>
                                @error('deskripsi') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-form-label col-sm-3">Resume</label>
                            <div class="col-sm-9">
                                <textarea name="resume" id="resume" class="form-control @error('resume') is-invalid @enderror" rows="4"></textarea>
                                @error('resume') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('note-karyawan.index')}}" type="button" class="btn btn-danger">Batal</a>
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