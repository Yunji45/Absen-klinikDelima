@extends('template.layout.app.main') 
@section('tabel')
<section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Profil Settings</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item active"><a href="#">Settings</a></div>
              <div class="breadcrumb-item">Profil Settings</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">All About Profil Settings</h2>
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
                      <li class="nav-item"><a href="{{route('setting-content.beranda')}}" class="nav-link">Profil</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.tentang')}}" class="nav-link active">Tentang</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.layanan')}}" class="nav-link">Layanan</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.divisi')}}" class="nav-link">Divisi</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.dokter')}}" class="nav-link">Dokter</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.faq')}}" class="nav-link">FAQ & Kontak</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <form action="{{route('setting-content.tentang.save')}}" id="setting-form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>Profil Settings</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Profil settings such as, site title, site description, address and so on.</p>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Sub Judul 1</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="sub_judul_1" class="form-control" id="sub_judul_1">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Content 1</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" name="content_1" id="content_1"></textarea>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Sub Judul 2</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="sub_judul_2" class="form-control" id="sub_judul_2">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Content 2</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" name="content_2" id="content_2"></textarea>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-3 text-md-right">Foto Content</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="custom-file">
                            <input type="file" name="foto_1" class="custom-file-input" id="foto_1">
                            <label class="custom-file-label">Choose File</label>
                          </div>
                          <div class="form-text text-muted">The image must have a maximum size of 2MB</div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                      <button class="btn btn-primary" id="save-btn">Save Changes</button>
                      <button class="btn btn-secondary" type="button">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
  		    </div>
      	</section>
@endsection