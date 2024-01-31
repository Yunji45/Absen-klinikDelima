@extends('template.layout.app.main') 
@section('tabel')
<section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit FAQ Settings</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item active"><a href="#">Settings</a></div>
              <div class="breadcrumb-item">Edit FAQ Settings</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">All About Edit FAQ Settings</h2>
            <p class="section-lead">
              You can adjust all general settings here
            </p>

            <div id="output-status"></div>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Jump To</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="{{route('setting-content.beranda')}}" class="nav-link">Layanan</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.tentang')}}" class="nav-link">Tentang</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.layanan')}}" class="nav-link">Layanan</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.divisi')}}" class="nav-link">Divisi</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Dokter</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.faq')}}" class="nav-link active">FAQ & Kontak</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <form action="{{route('setting-content.faq.update',$faq->id)}}" id="setting-form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>Edit FAQ Settings</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Edit FAQ settings such as, site title, site description, address and so on.</p>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Pertanyaan</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" name="pertanyaan" id="pertanyaan">{{old('pertanyaan',$faq->pertanyaan)}}</textarea>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Jawaban</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" name="jawaban" id="jawaban">{{old('jawaban',$faq->jawaban)}}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                      <button class="btn btn-primary" id="save-btn">Update Changes</button>
                      <button class="btn btn-secondary" type="button">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
  		    </div>
      	</section>
@endsection