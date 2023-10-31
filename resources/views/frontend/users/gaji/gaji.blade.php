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
                        <h1 class="display-4 text-dark">Slip Gaji</h1>
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
                            <strong>Pendidikan:</strong>
                            {{$gaji->pendidikan}}</p>
                        <p>
                            <strong>Periode:</strong>
                            {{$gaji->bulan}}</p>

                    </div>
                    <h2>Pendapatan</h2>
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

                    <!-- <h2>Potongan</h2>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Jenis Potongan</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <td>Potongan Pajak</td>
                            <td>Rp 1,000,000</td>
                        </tr>
                        <tr>
                            <td>Potongan BPJS</td>
                            <td>Rp 500,000</td>
                        </tr>
                        <tr>
                            <td>Total Potongan</td>
                            <td>Rp 1,500,000</td>
                        </tr>
                    </table> -->

                    <h2>Total Gaji Bersih</h2>
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
@endsection