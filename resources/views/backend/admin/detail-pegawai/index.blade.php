@extends('layouts.app')

@section('title')
Detail User - Klinik Mitra Delima
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Detail Pegawai</h5>
                        <form class="float-right d-inline-block" action="" method="get">
                            <button title="Download" type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-download">EXCEL</i>
                            </button>
                        </form>
                        <form class="float-right d-inline-block" action="" method="get">
                                <button title="Download" type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-download">PDF</i>
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
                                        <th>Nama</th>
                                        <th>TTL</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Jabatan</th>
                                        <th>No.Telp</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->place_birth}}, {{$item->date_birth}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->religion}}</td>
                                    <td>{{$item->position}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <a href="{{route('detail.info.admin',$item->id)}}" class="btn btn-sm btn-info" title="Detail User"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('delete.pegawai.admin',$item->id)}}" class="btn btn-sm btn-danger" title="Detail User"><i class="fas fa-trash"></i></a>
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