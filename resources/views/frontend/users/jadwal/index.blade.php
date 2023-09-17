@extends('layouts.app')

@section('title')
Jadwal Shift - Klinik Mitra Delima
@endsection
@section('content')
<style>
    .table-container {
    width: 100%;
    overflow-x: auto; /* Membuat tabel responsif jika terlalu lebar */
    margin: 0 auto; /* Pusatkan tabel secara horizontal */
}

table {
    width: 100%; /* Lebar tabel mengisi wadah */
    border-collapse: collapse;
}

th, td {
    padding: 2px; /* Atur padding sel header dan sel data */
}

th {
    background-color: yellow;
}

tr:nth-child(even) {
    background-color: #f2f2f2; /* Atur latar belakang baris ganjil */
}

/* Tambahkan gaya lain yang Anda inginkan di sini */

</style>

<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">{{$title}}</h5>
                        <form class="float-right d-inline-block" action="{{route('download.jadwal')}}" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cari.jadwal.user')}}" class="mb-3" method="get">
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
                        <div class="table-container">
                        <table border="1" style="text-align: center;">
                            <tr>
                                <th rowspan="2" bgcolor="yellow">NO</th>
                                <th rowspan="2" bgcolor="yellow">Nama Pegawai</th>
                                <th colspan="31" bgcolor="#00ff80" style="text-align: center;">Jadwal Shift</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= 31; $i++)
                                <th>{{ $i }}</th>
                                @endfor

                            </tr>
                            @php $no =1; @endphp @if($data->isEmpty())
                            <tr>
                                <td colspan="34" style="text-align: center; font-size: 14px;">Tidak ada data yang tersedia</td>
                            </tr>
                            @else @foreach ($data as $item)
                            <tr>
                                <td style="text-align: center; font-size: 14px;">{{$no++}}.</td>
                                <td style="text-align: center; font-size: 9px;">{{$item->user->name}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j1}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j2}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j3}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j4}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j5}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j6}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j7}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j8}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j9}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j10}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j11}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j12}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j13}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j14}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j15}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j16}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j17}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j18}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j19}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j20}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j21}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j22}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j23}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j24}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j25}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j26}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j27}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j28}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j29}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j30}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j31}}</td>
                            </tr>
                            @endforeach @endif

                        </table>                        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection