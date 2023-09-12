@extends('layouts.app')

@section('title')
Detail User - {{ config('app.name') }}
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">{{$title}}</h5>
                        <button title="Tambah Izin" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#kehadiran">
                                    <i class="fas fa-plus"></i>
                                </button>

                        <form class="float-right d-inline-block" action="{{route('download.jadwal')}}" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="" class="mb-3" method="get">
                            <div class="form-group row mb-3 ">
                                <label for="bulan" class="col-form-label col-sm-2">Bulan</label>
                                <div class="input-group col-sm-10">
                                    <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>21</th>
                                        <th>22</th>
                                        <th>23</th>
                                        <th>24</th>
                                        <th>25</th>
                                        <th>26</th>
                                        <th>27</th>
                                        <th>28</th>
                                        <th>29</th>
                                        <th>30</th>
                                        <th>31</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->j1}}</td>
                                    <td>{{$item->j2}}</td>
                                    <td>{{$item->j3}}</td>
                                    <td>{{$item->j4}}</td>
                                    <td>{{$item->j5}}</td>
                                    <td>{{$item->j6}}</td>
                                    <td>{{$item->j7}}</td>
                                    <td>{{$item->j8}}</td>
                                    <td>{{$item->j9}}</td>
                                    <td>{{$item->j10}}</td>
                                    <td>{{$item->j11}}</td>
                                    <td>{{$item->j12}}</td>
                                    <td>{{$item->j13}}</td>
                                    <td>{{$item->j14}}</td>
                                    <td>{{$item->j15}}</td>
                                    <td>{{$item->j16}}</td>
                                    <td>{{$item->j17}}</td>
                                    <td>{{$item->j18}}</td>
                                    <td>{{$item->j19}}</td>
                                    <td>{{$item->j20}}</td>
                                    <td>{{$item->j21}}</td>
                                    <td>{{$item->j22}}</td>
                                    <td>{{$item->j23}}</td>
                                    <td>{{$item->j24}}</td>
                                    <td>{{$item->j25}}</td>
                                    <td>{{$item->j26}}</td>
                                    <td>{{$item->j27}}</td>
                                    <td>{{$item->j28}}</td>
                                    <td>{{$item->j29}}</td>
                                    <td>{{$item->j30}}</td>
                                    <td>{{$item->j31}}</td>
                                    <td>
                                        <a href="{{ route('jadwal.hapus',$item->id)}}" class="btn btn-sm btn-danger" title="{{$title}}"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen pengguna ini?')">
                                        <i class="fas fa-trash"> Hapus</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">Form Input Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('jadwal.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="hidden" name="user_id" value="">
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama Pegawai </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    @foreach ($user as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Bulan </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
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
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="masa_aktif">
                            <label for="masa_aktif" class="col-form-label col-sm-3">Masa Aktif</label>
                            <div class="col-sm-9">
                                <input type="date" name="masa_aktif" id="masa_aktif" class="form-control @error('masa_aktif') is-invalid @enderror">
                                @error('masa_aktif') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="masa_akhir">
                            <label for="masa_akhir" class="col-form-label col-sm-3">Masa Akhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="masa_akhir" id="masa_akhir" class="form-control @error('masa_akhir') is-invalid @enderror">
                                @error('masa_akhir') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j1" class="col-form-label col-sm-3">Tanggal 1 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j1') is-invalid @enderror" name="j1" id="j1">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j1') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j2" class="col-form-label col-sm-3">Tanggal 2 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j2') is-invalid @enderror" name="j2" id="j2">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j2') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j3" class="col-form-label col-sm-3">Tanggal 3 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j3') is-invalid @enderror" name="j3" id="j3">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j3') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j4" class="col-form-label col-sm-3">Tanggal 4 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j4') is-invalid @enderror" name="j4" id="j4">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j4') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j5" class="col-form-label col-sm-3">Tanggal 5 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j5') is-invalid @enderror" name="j5" id="j5">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j5') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j6" class="col-form-label col-sm-3">Tanggal 6 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j6') is-invalid @enderror" name="j6" id="j6">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j6') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j7" class="col-form-label col-sm-3">Tanggal 7 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j7') is-invalid @enderror" name="j7" id="j7">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j7') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j1" class="col-form-label col-sm-3">Tanggal 1 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j1') is-invalid @enderror" name="j1" id="j1">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j7') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j8" class="col-form-label col-sm-3">Tanggal 8 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j8') is-invalid @enderror" name="j8" id="j8">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j8') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j9" class="col-form-label col-sm-3">Tanggal 9 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j9') is-invalid @enderror" name="j9" id="j9">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j9') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j10" class="col-form-label col-sm-3">Tanggal 10 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j10') is-invalid @enderror" name="j10" id="j10">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j10') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j11" class="col-form-label col-sm-3">Tanggal 11 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j11') is-invalid @enderror" name="j11" id="j11">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j11') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j12" class="col-form-label col-sm-3">Tanggal 12 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j12') is-invalid @enderror" name="j12" id="j12">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j1') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j13" class="col-form-label col-sm-3">Tanggal 13 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j13') is-invalid @enderror" name="j13" id="j13">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j13') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j14" class="col-form-label col-sm-3">Tanggal 14 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j14') is-invalid @enderror" name="j14" id="j14">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j14') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j15" class="col-form-label col-sm-3">Tanggal 15 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j15') is-invalid @enderror" name="j15" id="j15">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j15') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j16" class="col-form-label col-sm-3">Tanggal 16 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j16') is-invalid @enderror" name="j16" id="j16">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j16') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j17" class="col-form-label col-sm-3">Tanggal 17 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j17') is-invalid @enderror" name="j17" id="j17">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j17') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j18" class="col-form-label col-sm-3">Tanggal 18 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j18') is-invalid @enderror" name="j18" id="j18">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j18') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j19" class="col-form-label col-sm-3">Tanggal 19 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j19') is-invalid @enderror" name="j19" id="j19">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j19') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j20" class="col-form-label col-sm-3">Tanggal 20 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j20') is-invalid @enderror" name="j20" id="j20">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j20') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j21" class="col-form-label col-sm-3">Tanggal 21 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j2') is-invalid @enderror" name="j21" id="j21">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j21') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j22" class="col-form-label col-sm-3">Tanggal 22 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j22') is-invalid @enderror" name="j22" id="j22">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j22') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j23" class="col-form-label col-sm-3">Tanggal 23 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j23') is-invalid @enderror" name="j23" id="j23">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j23') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j24" class="col-form-label col-sm-3">Tanggal 24 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j24') is-invalid @enderror" name="j24" id="j24">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j24') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j25" class="col-form-label col-sm-3">Tanggal 25 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j25') is-invalid @enderror" name="j25" id="j25">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j25') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j26" class="col-form-label col-sm-3">Tanggal 26 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j26') is-invalid @enderror" name="j26" id="j26">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j26') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j27" class="col-form-label col-sm-3">Tanggal 27 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j27') is-invalid @enderror" name="j27" id="j27">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j27') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j28" class="col-form-label col-sm-3">Tanggal 28 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j28') is-invalid @enderror" name="j28" id="j28">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j20') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j29" class="col-form-label col-sm-3">Tanggal 29 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j29') is-invalid @enderror" name="j29" id="j29">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j29') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j30" class="col-form-label col-sm-3">Tanggal 30 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j30') is-invalid @enderror" name="j30" id="j30">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j30') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="j31" class="col-form-label col-sm-3">Tanggal 31 </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('j31') is-invalid @enderror" name="j31" id="j31">
                                    <option value="PS">PS</option>
                                    <option value="SM">SM</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="C">C</option>
                                    <option value="IJ">IJ</option>
                                </select>
                                @error('j31') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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
@endsection