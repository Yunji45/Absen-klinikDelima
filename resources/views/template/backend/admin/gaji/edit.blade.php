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
                    <form action="{{route('gaji.update',$gaji->id)}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                                    <option value="{{ date('m', strtotime($gaji->bulan)) }}">{{$gaji->bulan}}</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    <option value="{{$gaji->user->id}}">{{$gaji->user->name}}</option>
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
                                    <option value="{{$gaji->pendidikan}}">{{$gaji->pendidikan}}</option>
                                    <option value="Dokter">Dokter Umum</option>
                                    <option value="S1 Profesi">S1 Profesi</option>
                                    <option value="S1 Kesehatan Non Profesi">S1 Kesehatan Non Profesi</option>
                                    <option value="S1 Non Kesehatan">S1 Non Kesehatan </option>
                                    <option value="D3 Kesehatan">D3 Kesehatan</option>
                                    <option value="D3 Non Kesehatan">D3 Non Kesehatan</option>
                                    <option value="SMK Kesehatan">SMK Kesehatan</option>
                                    <option value="SLTA Non Kesehatan">SMK/SLTA Non Kesehatan</option>
                                    <option value="Dibawah SLTA">Dibawah SLTA</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>           
                        <div class="form-group row">
                            <label for="umr_id" class="col-form-label col-sm-3">UMR</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('umr_id') is-invalid @enderror" name="umr_id" id="umr_id">
                                    <option value="{{$gaji->umr->id}}">{{$gaji->umr->Rp}}</option>
                                    @foreach ($umr as $gaji)
                                    <option value="{{ $gaji->id }}">{{ $gaji->name }}/{{$gaji->Rp}}</option>
                                    @endforeach
                                </select>
                                @error('umr_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Masa_kerja" class="col-form-label col-sm-3">Masa Kerja</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('Masa_kerja') is-invalid @enderror" name="Masa_kerja" id="Masa_kerja">
                                    <option value="0" {{ old('Masa_kerja', $gaji->Masa_kerja) == 0 ? 'selected' : '' }}>Dibawah 1 tahun</option>
                                    <option value="1" {{ old('Masa_kerja', $gaji->Masa_kerja) == 1 ? 'selected' : '' }}>Diatas 1 tahun</option>
                                </select>
                                @error('Masa_kerja') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="Potongan">
                            <label for="Potongan" class="col-form-label col-sm-3">Potongan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('Potongan') is-invalid @enderror" name="Potongan" value="{{ old('Potongan', $gaji->Potongan) }}" placeholder="Masukkan 0 jika tidak ada potongan" required>
                                @error('Potongan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="Bonus">
                            <label for="Bonus" class="col-form-label col-sm-3">Tambahan</label>
                            <div class="col-sm-9">
                                <input type="text" name="Bonus" id="Bonus" class="form-control @error('Bonus') is-invalid @enderror" value="{{ old('Bonus',$gaji->Bonus) }}" placeholder="Masukkan 0 jika tidak ada Tambahan" required>
                                @error('Bonus') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
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