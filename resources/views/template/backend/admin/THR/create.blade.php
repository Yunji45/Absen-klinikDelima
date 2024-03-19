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
                    <form action="{{ route('thr.save') }}" method="post">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    @foreach ($data as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>             
                        <div class="form-group row">
                            <label for="pendidikan" class="col-form-label col-sm-3">Pendidikan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan">
                                    <option value="">Pilih</option>
                                    <option value="Dokter">Dokter Umum</option>
                                    <option value="S1 Profesi">S1 Profesi</option>
                                    <option value="S1 Kesehatan Non Profesi">S1 Kesehatan Non Profesi</option>
                                    <option value="S1 Non Kesehatan">S1 Non Kesehatan </option>
                                    <option value="D3 Kesehatan">D3 Kesehatan</option>
                                    <option value="D3 Kebidanan">D3 Kebidanan</option>
                                    <option value="D3 Keperawatan">D3 Keperawatan</option>
                                    <option value="D3 Non Kesehatan">D3 Non Kesehatan</option>
                                    <option value="SMK Kesehatan">SMK Kesehatan</option>
                                    <option value="SLTA Non Kesehatan">SMK/SLTA Non Kesehatan</option>
                                    <option value="Dibawah SLTA">Dibawah SLTA</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>        
                        <div class="form-group row" id="Bonus">
                            <label for="Bonus" class="col-form-label col-sm-3">Gaji Terakhir</label>
                            <div class="col-sm-9">
                                <input type="text" name="gaji_terakhir" id="gaji_terakhir" class="form-control @error('Bonus') is-invalid @enderror" placeholder="gaji terakhir" required>
                                @error('Bonus') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="index" class="col-form-label col-sm-3">Index THR</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pendidikan') is-invalid @enderror" name="index" id="index">
                                    <option value="">Pilih</option>
                                    <option value="0">0</option>
                                    <option value="100">1.0</option>
                                    <option value="90">0.9</option>
                                    <option value="80">0.8</option>
                                    <option value="70">0.7</option>
                                    <option value="60">0.6</option>
                                    <option value="50">0.5</option>
                                    <option value="40">0.4</option>
                                    <option value="30">0.3</option>
                                    <option value="20">0.2</option>
                                    <option value="10">0.1</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>           
                        <div class="form-group row" id="Bonus">
                            <label for="Bonus" class="col-form-label col-sm-3">Mulai Bekerja</label>
                            <div class="col-sm-9">
                                <input type="date" name="masuk" id="masuk" class="form-control @error('Bonus') is-invalid @enderror" placeholder="isi dengan 0 jika tidak ada tambahan" required>
                                @error('Bonus') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- <div class="form-group row" id="Bonus">
                            <label for="Bonus" class="col-form-label col-sm-3">berakhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="keluar" id="keluar" class="form-control @error('Bonus') is-invalid @enderror" placeholder="isi dengan 0 jika tidak ada tambahan" required>
                                @error('Bonus') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div> -->
                        <div class="modal-footer">
                            <a href="{{route('gaji.adm')}}" type="button" class="btn btn-secondary">Batal</a>
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