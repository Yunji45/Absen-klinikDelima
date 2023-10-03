@extends('layouts.app')

@section('title')
Hapus Sertifikat - Klinik Mitra Delima
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Sertifikat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{ $item->filename }}</td>
                                    <td>
                                        <a href="{{route('delete.sertifikat', $item->id)}}" class="btn btn-sm btn-danger" title="{{$title}}"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus sertifikat pengguna ini?')">
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