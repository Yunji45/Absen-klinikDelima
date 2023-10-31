@extends('layouts.app')

@section('title')
{{$title}} - Klinik Mitra Delima
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">{{$title}}</h5>
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
                                        <th>Pendidikan</th>
                                        <th>Masa Kerja</th>
                                        <th>Gaji</th>
                                        <th>Invoices Penerima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$gaji->user->name}}</td>
                                    <td>{{$gaji->pendidikan}}</td>
                                    <td>{{$gaji->user->detailpegawai->length_of_service}}</td>
                                    <td >{{'Rp.' . number_format(floatval($gaji->Gaji_akhir ?? '0'), 0, ',', '.')}}</td>
                                    <td>
                                        <a
                                            href="{{ $gaji->status_penerima == 'success' ? '#' : '/Payroll-confirm-penerima/' . $gaji->id }}"
                                            onclick="return @if ($gaji->status_penerima == 'success') confirm('Sudah Success Mas/Mba !!') @else true @endif"
                                            class="btn btn-sm @if ($gaji->status_penerima == 'success') bg-warning @else btn-danger @endif">
                                            @if ($gaji->status_penerima == 'success')
                                            <strong style="color: white;">success</strong>
                                            @else
                                            <strong>Diterima</strong>
                                            @endif
                                        </a>
       
                                    </td>
                                </tr>

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