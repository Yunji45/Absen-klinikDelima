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
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Pengajuan Izin</h5>
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
                        <!-- <form action="" class="mb-3" method="get">
                            <div class="form-group row mb-3 ">
                                <label for="bulan" class="col-form-label col-sm-2">Bulan</label>
                                <div class="input-group col-sm-10">
                                    <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form> -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($cuti as $item)
                                <tr>
                                    <!-- <td>{{$no++}}.</td> -->
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->jenis_izin}}</td>
                                    <td>{{$item->tanggal_mulai}}</td>
                                    <td>{{$item->tanggal_berakhir}}</td>
                                    <td>{{$item->alasan}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                            <a href=""
                                                onclick="return confirm('Anda Bukan Admin Yaa !!')"
                                                class="btn btn-sm @if ($item->status == 'approve') bg-success @else btn-danger @endif">
                                                @if ($item->status == 'approve')
                                                    <i class="fas fa-unlock-alt"></i><strong> Confirmed</strong>
                                                @else
                                                    <i class="fas fa-lock"></i><strong> Verifikasi</strong>
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
                    <h5 class="modal-title" id="kehadiranLabel">Form Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengajuan.cuti') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="hidden" name="user_id" value="">
                        <div class="form-group row">
                            <label for="keterangan" class="col-form-label col-sm-3">Jenis </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('jenis_izin') is-invalid @enderror" name="jenis_izin" id="jenis_izin">
                                    <option value="sakit">Sakit</option>
                                    <option value="izin">Izin</option>
                                    <option value="cuti_tahunan">Cuti Tahunan</option>
                                    <option value="cuti_bersama">Cuti Bersama</option>
                                    <option value="cuti_besar">Cuti Besar</option>
                                    <option value="cuti_melahirkan">Cuti Melahirkan</option>
                                </select>
                                @error('keterangan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="tanggal_mulai">
                            <label for="tanggal_mulai" class="col-form-label col-sm-3">Mulai</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                @error('tanggal_mulai') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="tanggal_berakhir">
                            <label for="tanggal_berakhir" class="col-form-label col-sm-3">Berakhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" class="form-control @error('tanggal_berakhir') is-invalid @enderror">
                                @error('tanggal_berakhir') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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