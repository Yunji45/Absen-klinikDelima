@extends('template.backend.karyawan.layouts.app')
@section('content')
<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.html">Insentif & Gaji</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="employee-info">
                                <br>
                                <p>
                                    <strong>Nama:</strong>
                                    {{$gaji->user->name}}</p>
                                <p>
                                    <strong>NIK:</strong>
                                    {{$gaji->user->nik}}</p>
                                <p>
                                    <strong>Periode:</strong>
                                    {{$gaji->bulan}}</p>

                            </div>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Jenis Kinerja</th>
                                    <th>Keterangan</th>
                                </tr>
                                <tr>
                                    <td>Poin Kinerja</td>
                                    <td>{{ number_format($kinerja->total_kinerja, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Performa Kinerja</td>
                                    <td>{{$kinerja->ket}} Ekspektasi</td>
                                </tr>
                                <tr>
                                    <td>Resume</td>
                                    <td>{{$catatan}}</td>
                                </tr>
                            </table>

                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Jenis Insentif</th>
                                    <th>Jumlah</th>
                                </tr>
                                <tr>
                                    <td>Insentif Bulan Ini</td>
                                    <td>{{'Rp.' . number_format(floatval($gaji->insentif_final ?? '0'), 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <td>Total Insentif</td>
                                    <td>{{'Rp.' . number_format(floatval($gaji->insentif_final ?? '0'), 0, ',', '.')}}</td>
                                </tr>
                            </table>
                            <h2>Total Insentif :</h2>
                            <p class="display-4 text-success">{{'Rp.' . number_format(floatval($gaji->insentif_final ?? '0'), 0, ',', '.')}}</p>
                            <td>
                                <p style="font-size: 12px;"><strong><em>"Jangan pernah menyerah pada impianmu. Kerja keras, konsistensi, dan keyakinan akan membawamu menuju kesuksesan."</em></strong></p>
                            </td>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection