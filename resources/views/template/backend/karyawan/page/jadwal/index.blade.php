@extends('template.backend.karyawan.layouts.app')
@section('content')
<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.html">Components</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

              <table class="table table-bordered border-primary table-responsive">
                <thead>
                  <tr>
                    <tr>
                                <th rowspan="2" bgcolor="yellow">No</th>
                                <th rowspan="2" bgcolor="yellow">Nama</th>
                                <th colspan="31" bgcolor="#00ff80" style="text-align: center;">Jadwal Shift</th>

                    </tr>
                    <tr>
                                @for ($i = 1; $i <= 31; $i++)
                                <th>{{ $i }}</th>
                                @endfor

                    </tr>
                    @php $no =1; @endphp 
                            @if($data->isEmpty())
                            <tr>
                                <td colspan="34" style="text-align: center; font-size: 14px;">Tidak ada data yang tersedia</td>
                            </tr>
                    @else 
                    @foreach ($data as $item)
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


                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
      </div>
    </section>
@endsection