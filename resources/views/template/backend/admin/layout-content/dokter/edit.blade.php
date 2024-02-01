@extends('template.layout.app.main') 
@section('tabel')
<style>
    .card-box {
    padding: 20px;
    border-radius: 3px;
    margin-bottom: 30px;
    background-color: #fff;
}

.social-links li a {
    border-radius: 50%;
    color: rgba(121, 121, 121, .8);
    display: inline-block;
    height: 30px;
    line-height: 27px;
    border: 2px solid rgba(121, 121, 121, .5);
    text-align: center;
    width: 30px
}

.social-links li a:hover {
    color: #797979;
    border: 2px solid #797979
}
.thumb-lg {
    height: 88px;
    width: 88px;
}
.img-thumbnail {
    padding: .25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    max-width: 100%;
    height: auto;
}
.text-pink {
    color: #ff679b!important;
}
.btn-rounded {
    border-radius: 2em;
}
.text-muted {
    color: #98a6ad!important;
}
h4 {
    line-height: 22px;
    font-size: 18px;
}

</style>
<section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Dokter Settings</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item active"><a href="#">Settings</a></div>
              <div class="breadcrumb-item">Edit Dokter Settings</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">All About Edit Dokter Settings</h2>
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
                      <li class="nav-item"><a href="{{route('setting-content.dokter')}}" class="nav-link active">Dokter</a></li>
                      <li class="nav-item"><a href="{{route('setting-content.faq')}}" class="nav-link">FAQ & Kontak</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <form action="{{route('setting-content.dokter.update',$dokter->id)}}" id="setting-form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>Edit Dokter Settings</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Edit Dokter settings such as, site title, site description, address and so on.</p>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Nama Dokter</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="{{old('nama_dokter',$dokter->nama_dokter)}}"></input>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Bidang Dokter</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" class="form-control" name="bidang" id="bidang" value="{{old('bidang',$dokter->bidang)}}"></input>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Foto Dokter</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="file" class="form-control" name="foto" id="foto"></input>
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