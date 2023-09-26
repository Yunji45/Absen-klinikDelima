@extends('layouts.app')

@section('title')
Permohonan Jadwal - Klinik Mitra Delima
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Permohonan Jadwal</h5>
                        <button title="Tambah Izin" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#kehadiran">
                                    <i class="fas fa-plus"></i>
                                </button>

                        <!-- <form class="float-right d-inline-block" action="" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </button>
                        </form> -->
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
                                        <th>Nama</th>
                                        <th>Permohonan</th>
                                        <th>Tanggal</th>
                                        <th>Pengganti</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($permohonan as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->permohonan}}</td>
                                    <td>{{$item->tanggal}}</td>
                                    <td>{{$item->pengganti}}</td>
                                    <td>{{$item->alasan}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                            <a href=""
                                                onclick="return confirm('Anda Bukan Admin Yaa !!')"
                                                class="btn btn-sm @if ($item->status == 'approve') bg-success @else btn-danger @endif">
                                                @if ($item->status == 'approve')
                                                    <i class="fas fa-unlock-alt"></i><strong> Terverifikasi</strong>
                                                @else
                                                    <i class="fas fa-lock"></i><strong> Belum Terverifikasi</strong>
                                                @endif
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
                    <h5 class="modal-title" id="kehadiranLabel">Form Permohonan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('permohonan.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group row">
                            <label for="permohonan" class="col-form-label col-sm-3">Jenis Permohonan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('permohonan') is-invalid @enderror" name="permohonan" id="permohonan">
                                    <option value="ganti_jaga">Ganti Jaga</option>
                                    <option value="tukar_jaga">Tukar Jaga</option>
                                    <option value="lembur">Lembur</option>
                                </select>
                                @error('permohonan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pengganti" class="col-form-label col-sm-3">Pengganti</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pengganti') is-invalid @enderror" name="pengganti" id="pengganti">
                                    <option value="">Tidak Ada</option>
                                    @foreach ($user as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('pengganti') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="tanggal">
                            <label for="tanggal" class="col-form-label col-sm-3">Pada Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="alasan">
                            <label for="alasan" class="col-form-label col-sm-3">Alasan</label>
                            <div class="col-sm-9">
                                <textarea name="alasan" rows="4" class="form-control @error('tanggal_berakhir') is-invalid @enderror" required></textarea>
                                @error('alasan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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