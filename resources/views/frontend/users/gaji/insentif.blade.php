@extends('layouts.app') @section('title')
{{$title}}
- Klinik Mitra Delima @endsection 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="m-0 pt-1 font-weight-bold float-left" style="color:white;">{{$title}}</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="display-4 text-dark">Slip Insentif</h1>
                    </div>
                    <div class="employee-info">
                        <h2>Informasi Karyawan</h2>
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
                    <h2>Kinerja Bulan Ini :</h2>
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

                    <h2>Insentif :</h2>
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
                    <h2>Total Insentif Bersih</h2>
                    <p class="display-4 text-warning">{{'Rp.' . number_format(floatval($gaji->insentif_final ?? '0'), 0, ',', '.')}}</p>
                    <td>
                        <p style="font-size: 12px;"><strong><em>"Jangan pernah menyerah pada impianmu. Kerja keras, konsistensi, dan keyakinan akan membawamu menuju kesuksesan."</em></strong></p>
                    </td>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection