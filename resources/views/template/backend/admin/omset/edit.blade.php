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
                    <form action="{{route('update.omset',$omset->id)}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-9">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror" required>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Omset Klinik</label>
                            <div class="col-sm-9">
                                <input type="number" name="omset" id="omset" class="form-control @error('name') is-invalid @enderror" value="{{ old('omset', $omset->omset) }}">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="index" class="col-form-label col-sm-3">Index</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pendidikan') is-invalid @enderror" name="index" id="index">
                                <option value="">Pilih</option>
                                    <option value="10.0">10.0</option>
                                    <option value="9.0">9.0</option>
                                    <option value="8.0">8.0</option>
                                    <option value="7.0">7.0</option>
                                    <option value="6.0">6.0</option>
                                    <option value="5.0">5.0</option>
                                    <option value="4.0">4.0</option>
                                    <option value="0">Batas 3.0</option>
                                    <option value="3.9">3.9</option>
                                    <option value="3.8">3.8</option>
                                    <option value="3.7">3.7</option>
                                    <option value="3.6">3.6</option>
                                    <option value="3.5">3.5</option>
                                    <option value="3.4">3.4</option>
                                    <option value="3.3">3.3</option>
                                    <option value="3.2">3.2</option>
                                    <option value="3.1">3.1</option>
                                    <option value="3.0">3.0</option>
                                    <option value="0">Batas 2.0</option>
                                    <option value="2.0">2.0</option>
                                    <option value="1.9">1.9</option>
                                    <option value="1.8">1.8</option>
                                    <option value="1.7">1.7</option>
                                    <option value="1.6">1.6</option>
                                    <option value="1.5">1.5</option>
                                    <option value="1.4">1.4</option>
                                    <option value="1.3">1.3</option>
                                    <option value="1.2">1.2</option>
                                    <option value="1.1">1.1</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>                
                        <div class="modal-footer">
                            <a href="{{route('setup.insentif')}}" type="button" class="btn btn-secondary">Batal</a>
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