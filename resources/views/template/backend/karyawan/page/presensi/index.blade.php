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
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Total Jam</th>
                    <th scope="col">Total Lembur</th>
                  </tr>
                </thead>
                <tbody>
                @php $no =1; 
                @endphp 
                            @if (!$presents->count())
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data yang tersedia</td>
                                </tr>
                            @else
                                @foreach ($presents as $present)
                                    <tr>
                                        <th scope="row">{{$no++}}.</th>
                                        <td>{{ date('d/m/Y', strtotime($present->tanggal)) }}</td>
                                        <td>{{ $present->keterangan }}</td>
                                        @if ($present->jam_masuk)
                                            <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if($present->jam_keluar)
                                            <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                                            <td>
                                                <!-- @if (strtotime($present->jam_keluar) <= strtotime($present->jam_masuk))
                                                    {{ 21 - (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) }}
                                                @else
                                                    @if (strtotime($present->jam_keluar) >= strtotime(config('absensi.jam_pulang') . ' +2 hours'))
                                                        {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 3 }}
                                                    @else
                                                        {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 1 }}
                                                    @endif
                                                @endif -->
                                                @php
                                                    $jamMasuk = \Carbon\Carbon::parse($present->jam_masuk);
                                                    $jamKeluar = \Carbon\Carbon::parse($present->jam_keluar);
                                                    $totalJam = $jamMasuk->diffInHours($jamKeluar);
                                                @endphp
                                                {{ $totalJam }}
                                            </td>
                                            <td>-</td>
                                        @else
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                </tbody>
              </table>
      </div>
    </section>
@endsection