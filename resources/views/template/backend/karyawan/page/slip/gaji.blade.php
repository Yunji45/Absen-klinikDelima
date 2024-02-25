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
                                    <strong>Pendidikan:</strong>
                                    {{$gaji->pendidikan}}</p>
                                <p>
                                    <strong>Periode:</strong>
                                    {{$gaji->bulan}}</p>

                            </div>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Jenis Pendapatan</th>
                                    <th>Jumlah</th>
                                </tr>
                                <tr>
                                    <td>Gaji Pokok</td>
                                    <td>{{'Rp.' . number_format(floatval($gaji->Gaji_akhir ?? '0'), 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <td>Total Pendapatan</td>
                                    <td>{{'Rp.' . number_format(floatval($gaji->Gaji_akhir ?? '0'), 0, ',', '.')}}</td>
                                </tr>
                            </table>
                            <h2>Total Gaji :</h2>
                            <p class="display-4 text-success">{{'Rp.' . number_format(floatval($gaji->Gaji_akhir ?? '0'), 0, ',', '.')}}</p>
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
                                <br>
                                <p style="font-size: 12px;"><strong><em>Pastikan gaji sudah masuk rekening dan klik DITERIMA untuk konfirmasi !!</em></strong></p>
                            </td>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection