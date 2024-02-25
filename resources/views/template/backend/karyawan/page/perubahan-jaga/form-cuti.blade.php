@extends('template.backend.karyawan.layouts.app')
@section('content')
<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('daftar-hadir')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.html">Forms</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$title}} Form</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{route('pengajuan.cuti')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="col-12">
                                <label for="keterangan" class="col-form-label col-sm-3">Jenis Pengajuan</label>
                                <div class="col-sm-12">
                                    <select class="form-control @error('jenis_izin') is-invalid @enderror" name="jenis_izin" id="jenis_izin">
                                        <option value="sakit">Sakit</option>
                                        <option value="izin">Izin</option>
                                        <option value="cuti_tahunan">Cuti Tahunan</option>
                                        <option value="cuti_bersama">Cuti Bersama</option>
                                        <option value="cuti_besar">Cuti Besar</option>
                                        <option value="cuti_melahirkan">Cuti Melahirkan</option>
                                    </select>
                                    @error('keterangan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label for="tanggal_mulai" class="col-form-label col-sm-3">Mulai</label>
                                <div class="col-sm-12">
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                    @error('tanggal_mulai') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>                         
                            </div>
                            <div class="col-12">
                                <label for="tanggal_berakhir" class="col-form-label col-sm-3">Berakhir</label>
                                <div class="col-sm-12">
                                    <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" class="form-control @error('tanggal_berakhir') is-invalid @enderror">
                                    @error('tanggal_berakhir') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>                       
                            </div>
                            <div class="col-12">
                                <label for="alasan" class="col-form-label col-sm-3">Alasan</label>
                                <div class="col-sm-12">
                                    <textarea name="alasan" rows="4" class="form-control @error('tanggal_berakhir') is-invalid @enderror" required></textarea>
                                    @error('alasan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div>
      </div>
    </section>
@endsection