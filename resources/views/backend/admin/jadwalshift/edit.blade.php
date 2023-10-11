@extends('layouts.app') 
@section('title') 
Jadwal Shift - Klinik Mitra Delima
@endsection 
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12 mb-1">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold float-left">{{$title}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('jadwal.update',$jadwal->id)}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                            <input type="hidden" name="user_id" value="">
                            <div class="form-group row">
                                <label for="user_id" class="col-form-label col-sm-3">Nama Pegawai
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('user_id') is-invalid @enderror"
                                        name="user_id"
                                        id="user_id">
                                        @foreach ($user as $data)
                                        <option value="{{$data->id}}" {{ $data->id == $jadwal->user_id ? 'selected' : '' }}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bulan" class="col-form-label col-sm-3">Bulan
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('bulan') is-invalid @enderror"
                                        name="bulan"
                                        id="bulan">
                                        <option value="">Pilih</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                    @error('bulan')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="masa_aktif">
                                <label for="masa_aktif" class="col-form-label col-sm-3">Masa Aktif</label>
                                <div class="col-sm-9">
                                    <input
                                        type="date"
                                        name="masa_aktif"
                                        id="masa_aktif"
                                        class="form-control @error('masa_aktif') is-invalid @enderror" value="{{$jadwal->masa_aktif}}">
                                    @error('masa_aktif')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="masa_akhir">
                                <label for="masa_akhir" class="col-form-label col-sm-3">Masa Akhir</label>
                                <div class="col-sm-9">
                                    <input
                                        type="date"
                                        name="masa_akhir"
                                        id="masa_akhir"
                                        class="form-control @error('masa_akhir') is-invalid @enderror" value="{{$jadwal->masa_akhir}}">
                                    @error('masa_akhir')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j1" class="col-form-label col-sm-3">Tanggal 1
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j1') is-invalid @enderror"
                                        name="j1"
                                        id="j1" value="{{$jadwal->j1}}">
                                        <option value="{{$jadwal->j1}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>
                                    </select>
                                    @error('j1')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j2" class="col-form-label col-sm-3">Tanggal 2
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j2') is-invalid @enderror"
                                        name="j2"
                                        id="j2">
                                        <option value="{{$jadwal->j2}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>
                                    </select>
                                    @error('j2')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j3" class="col-form-label col-sm-3">Tanggal 3
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j3') is-invalid @enderror"
                                        name="j3"
                                        id="j3">
                                        <option value="{{$jadwal->j3}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>
                                    </select>
                                    @error('j3')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j4" class="col-form-label col-sm-3">Tanggal 4
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j4') is-invalid @enderror"
                                        name="j4"
                                        id="j4">
                                        <option value="{{$jadwal->j4}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j4')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j5" class="col-form-label col-sm-3">Tanggal 5
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j5') is-invalid @enderror"
                                        name="j5"
                                        id="j5">
                                        <option value="{{$jadwal->j5}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j5')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j6" class="col-form-label col-sm-3">Tanggal 6
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j6') is-invalid @enderror"
                                        name="j6"
                                        id="j6">
                                        <option value="{{$jadwal->j6}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j6')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j7" class="col-form-label col-sm-3">Tanggal 7
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j7') is-invalid @enderror"
                                        name="j7"
                                        id="j7">
                                        <option value="{{$jadwal->j7}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j7')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j8" class="col-form-label col-sm-3">Tanggal 8
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j8') is-invalid @enderror"
                                        name="j8"
                                        id="j8">
                                        <option value="{{$jadwal->j8}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j8')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j9" class="col-form-label col-sm-3">Tanggal 9
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j9') is-invalid @enderror"
                                        name="j9"
                                        id="j9">
                                        <option value="{{$jadwal->j9}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j9')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j10" class="col-form-label col-sm-3">Tanggal 10
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j10') is-invalid @enderror"
                                        name="j10"
                                        id="j10">
                                        <option value="{{$jadwal->j10}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j10')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j11" class="col-form-label col-sm-3">Tanggal 11
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j11') is-invalid @enderror"
                                        name="j11"
                                        id="j11">
                                        <option value="{{$jadwal->j11}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j11')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j12" class="col-form-label col-sm-3">Tanggal 12
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j12') is-invalid @enderror"
                                        name="j12"
                                        id="j12">
                                        <option value="{{$jadwal->j12}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j1')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j13" class="col-form-label col-sm-3">Tanggal 13
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j13') is-invalid @enderror"
                                        name="j13"
                                        id="j13">
                                        <option value="{{$jadwal->j13}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j13')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j14" class="col-form-label col-sm-3">Tanggal 14
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j14') is-invalid @enderror"
                                        name="j14"
                                        id="j14">
                                        <option value="{{$jadwal->j14}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j14')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j15" class="col-form-label col-sm-3">Tanggal 15
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j15') is-invalid @enderror"
                                        name="j15"
                                        id="j15">
                                        <option value="{{$jadwal->j15}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j15')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j16" class="col-form-label col-sm-3">Tanggal 16
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j16') is-invalid @enderror"
                                        name="j16"
                                        id="j16">
                                        <option value="{{$jadwal->j16}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j16')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j17" class="col-form-label col-sm-3">Tanggal 17
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j17') is-invalid @enderror"
                                        name="j17"
                                        id="j17">
                                        <option value="{{$jadwal->j17}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j17')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j18" class="col-form-label col-sm-3">Tanggal 18
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j18') is-invalid @enderror"
                                        name="j18"
                                        id="j18">
                                        <option value="{{$jadwal->j18}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j18')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j19" class="col-form-label col-sm-3">Tanggal 19
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j19') is-invalid @enderror"
                                        name="j19"
                                        id="j19">
                                        <option value="{{$jadwal->j19}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j19')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j20" class="col-form-label col-sm-3">Tanggal 20
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j20') is-invalid @enderror"
                                        name="j20"
                                        id="j20">
                                        <option value="{{$jadwal->j20}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j20')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j21" class="col-form-label col-sm-3">Tanggal 21
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j21') is-invalid @enderror"
                                        name="j21"
                                        id="j21">
                                        <option value="{{$jadwal->j21}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j21')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j22" class="col-form-label col-sm-3">Tanggal 22
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j22') is-invalid @enderror"
                                        name="j22"
                                        id="j22">
                                        <option value="{{$jadwal->j22}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j22')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j23" class="col-form-label col-sm-3">Tanggal 23
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j23') is-invalid @enderror"
                                        name="j23"
                                        id="j23">
                                        <option value="{{$jadwal->j23}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j23')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j24" class="col-form-label col-sm-3">Tanggal 24
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j24') is-invalid @enderror"
                                        name="j24"
                                        id="j24">
                                        <option value="{{$jadwal->j24}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j24')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j25" class="col-form-label col-sm-3">Tanggal 25
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j25') is-invalid @enderror"
                                        name="j25"
                                        id="j25">
                                        <option value="{{$jadwal->j25}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j25')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j26" class="col-form-label col-sm-3">Tanggal 26
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j26') is-invalid @enderror"
                                        name="j26"
                                        id="j26">
                                        <option value="{{$jadwal->j26}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j26')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j27" class="col-form-label col-sm-3">Tanggal 27
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j27') is-invalid @enderror"
                                        name="j27"
                                        id="j27">
                                        <option value="{{$jadwal->j27}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j27')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j28" class="col-form-label col-sm-3">Tanggal 28
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j28') is-invalid @enderror"
                                        name="j28"
                                        id="j28">
                                        <option value="{{$jadwal->j28}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j20')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j29" class="col-form-label col-sm-3">Tanggal 29
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j29') is-invalid @enderror"
                                        name="j29"
                                        id="j29">
                                        <option value="{{$jadwal->j29}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j29')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j30" class="col-form-label col-sm-3">Tanggal 30
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j30') is-invalid @enderror"
                                        name="j30"
                                        id="j30">
                                        <option value="{{$jadwal->j30}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j30')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="j31" class="col-form-label col-sm-3">Tanggal 31
                                </label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('j31') is-invalid @enderror"
                                        name="j31"
                                        id="j31">
                                        <option value="{{$jadwal->j31}}">Data Lama</option>
                                        <option value="PS">PS</option>
                                        <option value="SM">SM</option>
                                        <option value="PM">PM</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="C">C</option>
                                        <option value="IJ">IJ</option>
                                        <option value="LL">LL</option>

                                    </select>
                                    @error('j31')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection