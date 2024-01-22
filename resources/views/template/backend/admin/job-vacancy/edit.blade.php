@extends('template.layout.app.main') 
@section('tabel')
        <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="{{route('job-vacancy.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Post {{$title}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Lowongan Pekerjaan</a></div>
              <div class="breadcrumb-item">Edit Post {{$title}}</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Edit Post {{$title}}</h2>
            <p class="section-lead">
              On this page you can create a new post and fill in all fields.
            </p>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Write Your Post {{$title}}</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('job-vacancy.update',$job->id)}}" method="post">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="category" id="category">
                                    <option value="{{$job->category}}">{{$job->category}}</option>
                                    <option value="Nakes">Nakes</option>
                                    <option value="Non Nakes">Non Nakes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Posisi</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="position" id="position" value="{{old('position',$job->position)}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi Hiring</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{old('deskripsi',$job->deskripsi)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 1</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_1" value="{{old('kualifikasi_1',$job->kualifikasi_1)}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 2</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_2" value="{{old('kualifikasi_2',$job->kualifikasi_2)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 3</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_3" value="{{old('kualifikasi_3',$job->kualifikasi_3)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 4</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_4" value="{{old('kualifikasi_4',$job->kualifikasi_4)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 5</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_5" value="{{old('kualifikasi_5',$job->kualifikasi_5)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 6</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_6" value="{{old('kualifikasi_6',$job->kualifikasi_6)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 7</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_7" value="{{old('kualifikasi_7',$job->kualifikasi_7)}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 8</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_8" value="{{old('kualifikasi_8',$job->kualifikasi_8)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 9</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_9" value="{{old('kualifikasi_9',$job->kualifikasi_9)}}">
                            </div>
                        </div><div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kriteria 10</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control inputtags" name="kualifikasi_10" value="{{old('kualifikasi_10',$job->kualifikasi_10)}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary">Update Lowongan {{$title}}</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection