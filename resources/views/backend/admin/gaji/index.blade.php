@extends('layouts.app')

@section('title')
    Gaji - Klinik Mitra Delima
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Data Payroll</h5>

                        <form class="float-right d-inline-block" action="" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </button>
                            <button title="Tambah Kehadiran" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#kehadiran">
                                    <i class="fas fa-plus">ADD</i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cari.gaji')}}" class="mb-3" method="get">
                            <div class="form-group row mb-3 ">
                                <label for="bulan" class="col-form-label col-sm-2">Bulan</label>
                                <div class="input-group col-sm-10">
                                <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan', date('Y-m')) }}" min="1900-01" max="{{ date('Y-m') }}">
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
                                        <th>Pendidikan</th>
                                        <th>Gaji Final</th>
                                        <th>UMR</th>
                                        <th>Masa Kerja</th>
                                        <th>Persentase</th>
                                        <th>THP</th>
                                        <th>(80%)</th>
                                        <th>(20%)</th>
                                        <th>Tambahan</th>
                                        <th>Potongan</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($gaji as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{ $item->pendidikan }}</td>
                                    <td>{{ 'Rp.' . number_format(floatval($item->Gaji_akhir), 0, ',', '.') }}</td>
                                    <td>{{ $item->UMR->Rp }}</td>
                                    <td>{{ $item->Masa_kerja }}</td>
                                    <td>{{ $item->index }}%</td>
                                    <td>{{ 'Rp.' . number_format(floatval($item->THP), 0, ',', '.') }}</td>
                                    <td>{{ 'Rp.' . number_format(floatval($item->Gaji), 0, ',', '.') }}</td>
                                    <td>{{ 'Rp.' . number_format(floatval($item->Ach), 0, ',', '.') }}</td>
                                    <td>{{ 'Rp.' . number_format(floatval($item->Bonus ?? '0'), 0, ',', '.') }}</td>
                                    <td>{{ 'Rp.' . number_format(floatval($item->Potongan ?? '0'), 0, ',', '.') }}</td>
                                    <td>{{ $item->bulan }}</td>
                                    <td>
                                        <a href="{{route('gaji.delete',$item->id)}}" class="btn btn-sm btn-danger" title="{{$title}}"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen pengguna ini?')">
                                        <i class="fas fa-trash"></i>
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
    <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">Tambah Kehadiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('gaji.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    @foreach ($data as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>             
                        <div class="form-group row">
                            <label for="pendidikan" class="col-form-label col-sm-3">Pendidikan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan">
                                    <option value="">Pilih</option>
                                    <option value="Dokter Umum">Dokter Umum</option>
                                    <option value="S1 Profesi">S1 Profesi</option>
                                    <option value="S1 Kesehatan Non Profesi">S1 Kesehatan Non Profesi</option>
                                    <option value="S1 Non Kesehatan">S1 Non Kesehatan </option>
                                    <option value="D3 Kesehatan">D3 Kesehatan</option>
                                    <option value="D3 Non Kesehatan">D3 Non Kesehatan</option>
                                    <option value="SMK Kesehatan">SMK Kesehatan</option>
                                    <option value="SMK/SLTA Non Kesehatan">SMK/SLTA Non Kesehatan</option>
                                    <option value="Dibawah SLTA">Dibawah SLTA</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>           
                        <div class="form-group row">
                            <label for="umr_id" class="col-form-label col-sm-3">UMR</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('umr_id') is-invalid @enderror" name="umr_id" id="umr_id">
                                    <option value="">Pilih</option>
                                    @foreach ($umr as $gaji)
                                    <option value="{{ $gaji->id }}">{{ $gaji->name }}/{{$gaji->Rp}}</option>
                                    @endforeach
                                </select>
                                @error('umr_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="index" class="col-form-label col-sm-3">Persentase</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('index') is-invalid @enderror" name="index" id="index">
                                    <option value="">Pilih</option>
                                    <option value="500">5.0</option>
                                    <option value="400">4.0</option>
                                    <option value="300">3.0</option>
                                    <option value="190">1.9</option>
                                    <option value="180">1.8</option>
                                    <option value="170">1.7</option>
                                    <option value="160">1.6</option>
                                    <option value="150">1.5</option>
                                    <option value="140">1.4</option>
                                    <option value="130">1.3</option>
                                    <option value="120">1.2</option>
                                    <option value="110">1.1</option>
                                    <option value="100">1.0</option>
                                    <option value="90">0.9</option>
                                    <option value="80">0.8</option>
                                    <option value="70">0.7</option>
                                </select>
                                @error('index') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Masa_kerja" class="col-form-label col-sm-3">Masa Kerja</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('Masa_kerja') is-invalid @enderror" name="Masa_kerja" id="Masa_kerja">
                                    <option value="0">Dibawah 1 tahun</option>
                                    <option value="1">Diatas 1 tahun</option>
                                </select>
                                @error('Masa_kerja') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="Potongan">
                            <label for="Potongan" class="col-form-label col-sm-3">Potongan</label>
                            <div class="col-sm-9">
                                <input type="text" name="Potongan" id="Potongan" class="form-control @error('name') is-invalid @enderror" placeholder="isi dengan 0 jika tidak ada potongan" required>
                                @error('Potongan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="Bonus">
                            <label for="Bonus" class="col-form-label col-sm-3">Tambahan</label>
                            <div class="col-sm-9">
                                <input type="text" name="Bonus" id="Bonus" class="form-control @error('Bonus') is-invalid @enderror" placeholder="isi dengan 0 jika tidak ada potongan tambahan" required>
                                @error('Bonus') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection