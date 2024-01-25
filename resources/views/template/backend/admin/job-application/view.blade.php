@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header">
        <h1>Profil Kandidat {{$detail->nama_lengkap}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">{{$title}}</div>
        </div>
    </div>
    <div class="container">
    <div class="main-body">    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset(Storage::url('hiring-foto/' . $detail->foto)) }}" alt="Image" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $detail->name }}</h4>
                      <p class="text-secondary mb-1">Kandidat</p>
                      <p class="text-muted font-size-sm">Klinik Mitra Delima, INA</p>
                      <button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-danger " target="__blank" href="">POIN REQUIRMENT</a>
                    </div>
                  </div>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_1)
                        <h6>- {{ $detail->vacancy->kualifikasi_1 }}</h6>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_2)
                        <h6>- {{ $detail->vacancy->kualifikasi_2 }}</h6>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_3)
                        <h6>- {{ $detail->vacancy->kualifikasi_3 }}</h6>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_4)
                        <h6>- {{ $detail->vacancy->kualifikasi_4 }}</h6>
                    @endif
                  </li><li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_5)
                        <h6>- {{ $detail->vacancy->kualifikasi_5 }}</h6>
                    @endif
                  </li><li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_6)
                        <h6>- {{ $detail->vacancy->kualifikasi_6 }}</h6>
                    @endif
                  </li><li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_7)
                        <h6>- {{ $detail->vacancy->kualifikasi_7 }}</h6>
                    @endif
                  </li><li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_8)
                        <h6>- {{ $detail->vacancy->kualifikasi_8 }}</h6>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_9)
                        <h6>- {{ $detail->vacancy->kualifikasi_9 }}</h6>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if($detail->vacancy->kualifikasi_10)
                        <h6>- {{ $detail->vacancy->kualifikasi_10 }}</h6>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-primary " target="__blank" href="">PROFILE KANDIDAT</a>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nama Lengkap</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                      : {{ $detail->nama_lengkap }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                        : {{ $detail->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Cover Letter</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                        : {{ $detail->cover_letter}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Posisi Yang Dilamar</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                        : {{ $detail->vacancy->position}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Kategori</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                        : {{ $detail->vacancy->category}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Ciculum Vitae</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                        @if($detail->file_cv)
                        : <a href="{{ asset(Storage::url('hiring-cv/'.$detail->file_cv)) }}">file CV</a>
                        @else
                        : Tidak Ada File
                        @endif                    
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">File Pendukung</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                        @if($detail->file_pendukung)
                        : <a href="{{ asset(Storage::url('hiring-file-pendukung/'.$detail->file_pendukung)) }}">file pendukung</a>
                        @else
                        : Tidak Ada File
                        @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info" href="{{route('job-app')}}">Kembali</a>
                    </div>
                  </div>
                    
                </div>
              </div>

             

            </div>
          </div>

        </div>
    </div>
</section>


<style>
body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>
@endsection