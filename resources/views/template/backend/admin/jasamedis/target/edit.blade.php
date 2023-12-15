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
                    <form action="{{route('target.jasa.medis.update',$jasa->id)}}" method="post">
                        @csrf
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Nama Layanan</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_standar_opr" id="nama_standar_opr" class="form-control @error('name') is-invalid @enderror" value="{{ old('nama_standar_opr', $jasa->nama_standar_opr) }}">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Start Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="start_date" id="start_date" class="form-control @error('name') is-invalid @enderror" value="{{ old('start_date', $jasa->start_date) }}">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">End Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="end_date" id="end_date" class="form-control @error('name') is-invalid @enderror" value="{{ old('end_date', $jasa->end_date) }}">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Jenis Layanan</label>
                            <div class="col-sm-9">
                                <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control @error('name') is-invalid @enderror" value="{{ old('jenis_layanan', $jasa->jenis_layanan) }}">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Jenis Jasa</label>
                            <div class="col-sm-9">
                                <input type="text" name="jenis_jasa" id="jenis_jasa" class="form-control @error('name') is-invalid @enderror" value="{{ old('jenis_jasa', $jasa->jenis_jasa) }}">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Tarif Jasa</label>
                            <div class="col-sm-9">
                                <input type="number" name="tarif_jasa" id="tarif_jasa" class="form-control @error('name') is-invalid @enderror" value="{{ old('tarif_jasa', $jasa->tarif_jasa) }}">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('target.jasa.medis')}}" type="button" class="btn btn-secondary">Batal</a>
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