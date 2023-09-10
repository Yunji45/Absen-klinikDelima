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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Dokumen</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->jumlah_dokumen }}</td>
                                    <td>
                                        <a href="{{ route('delete.dokumen')}}" class="btn btn-sm btn-danger" title="{{$title}}"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen pengguna ini?')">
                                        <i class="fas fa-trash"> Hapus Dokumen</i>
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