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
                    <form action="{{route('opr.medis.update',$opr->id)}}" method="post">
                        @csrf
                        <div class="form-group row" id="name">
                                <label for="jam_masuk" class="col-form-label col-sm-3">Bulan</label>
                                <div class="col-sm-9">
                                    <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror" value="{{ old('bulan', $opr->bulan) }}">
                                    @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Petugas</label>
                                <div class="col-sm-9">
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="{{$opr->user_id}}">{{$opr->user->name}}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">No RM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="No_RM" id="No_RM" class="form-control @error('name') is-invalid @enderror" value="{{ old('No_RM', $opr->No_RM) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control @error('name') is-invalid @enderror" value="{{ old('nama_pasien', $opr->nama_pasien) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Jenis Layanan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control @error('name') is-invalid @enderror" value="{{ old('jenis_layanan', $opr->jenis_layanan) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Jenis Jasa</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jenis_jasa" id="jenis_jasa" class="form-control @error('name') is-invalid @enderror" value="{{ old('jenis_jasa', $opr->jenis_jasa) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Tarif Jasa</label>
                                <div class="col-sm-9">
                                    <input type="number" name="tarif_jasa" id="tarif_jasa" class="form-control @error('name') is-invalid @enderror" value="{{ old('tarif_jasa', $opr->tarif_jasa) }}">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <div class="modal-footer">
                            <a href="{{route('opr.medis')}}" type="button" class="btn btn-danger">Batal</a>
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