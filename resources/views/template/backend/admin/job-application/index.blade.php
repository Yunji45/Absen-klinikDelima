@extends('template.layout.app.main') 
@section('tabel')
        <section class="section">
          <div class="section-header">
            <h1>{{$title}}</h1>
            
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">{{$title}}</a></div>
              <div class="breadcrumb-item">All Posts</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Posts {{$title}}</h2>

            <div class="row">
              <div class="col-12">
                <div class="card mb-0">
                 
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Posts {{$title}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="float-left">
                      <select class="form-control selectric">
                        <option>Action For Selected</option>
                        <option>Move to Draft</option>
                        <option>Move to Pending</option>
                        <option>Delete Pemanently</option>
                      </select>
                    </div>
                    <div class="float-right">
                      <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search">
                          <div class="input-group-append">                                            
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                          <th>No</th>
                          <th>Posisi Yang Dilamar</th>
                          <th>Category</th>
                          <th>Nama kandidat</th>
                          <th>Email</th>
                          <th>Waktu Submit</th>
                          <th>Status</th>
                        </tr>
                        @php $no =1; @endphp 
                        @foreach ($job as $item)
                        <tr>
                          <td>{{$no++}}.</td>
                          <td>
                            <a href="#">{{$item->vacancy->position}}</a>
                          </td>
                          <td>{{$item->vacancy->category}}
                            <div class="table-links">
                              <a href="{{route('job-app.show',$item->id)}}">View</a>
                              <div class="bullet"></div>
                              <a href="{{route('job-vacancy.delete',$item->id)}}" class="text-danger">Hapus</a>
                            </div>
                          </td>
                          <td>{{$item->nama_lengkap}}</td>
                          <td>{{$item->email}}</td>
                          <td>{{$item->created_at}}</td>
                          <td><div class="badge badge-warning">In Queue</div></td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                    <div class="float-right">
                      <nav>
                        <ul class="pagination">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection