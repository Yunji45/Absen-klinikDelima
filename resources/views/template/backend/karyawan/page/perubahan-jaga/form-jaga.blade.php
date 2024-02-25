@extends('template.backend.karyawan.layouts.app')
@section('content')
<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('daftar-hadir')}}">Dashboard</a></li>
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
                        <form class="row g-3" action="{{route('permohonan.save')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="col-12">
                                <label for="permohonan" class="col-form-label col-sm-3">Jenis Permohonan</label>
                                <div class="col-sm-12">
                                    <select class="form-control @error('permohonan') is-invalid @enderror" name="permohonan" id="permohonan">
                                        <option value="ganti_jaga">Ganti Jaga</option>
                                        <option value="tukar_jaga">Tukar Jaga</option>
                                        <option value="lembur">Lembur</option>
                                    </select>
                                    @error('permohonan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="pengganti" class="col-form-label col-sm-3">Pengganti</label>
                                <div class="col-sm-12">
                                    <select class="form-control @error('pengganti') is-invalid @enderror" name="pengganti" id="pengganti">
                                        <option value="">Tidak Ada</option>
                                        @foreach ($user as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pengganti') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="col-form-label col-sm-3">Tanggal</label>
                                <div class="col-sm-12">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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