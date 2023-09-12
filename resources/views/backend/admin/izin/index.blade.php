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
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Konfirmasi Izin</h5>

                        <form class="float-right d-inline-block" action="" method="get">
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
                        <div class="mb-3">
                            <h3>dnsk</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Izin</th>
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
                                    <a href="{{ $item->status == 'approve' ? '#' : '/VerifikasiIzin/' . $item->id . '/berhasil' }}"
                                        onclick="return @if ($item->status == 'approve') confirm('Sudah Di Approve Mas/Mba !!') @else true @endif"
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
@endsection