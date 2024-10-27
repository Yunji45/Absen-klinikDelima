@extends('template.layout.app.main') @section('tabel')
<section class="section">
  <div class="section-header mt-4 d-flex justify-content-between align-items-center">
    <div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">{{$title}}</div>
      </div>
      <h1 class="mt-3">{{$title}}</h1>
    </div>
    <div>
        <a href="{{route('daftar.tugas')}}" class="btn btn-danger">
            <i class="fas fa-arrow-left">
                </i> Back
        </a>
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#update">
          <i class="fas fa-search">
              </i> Period
      </a>
    </div>
  </div>
  
    <div class="section-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-statistic-2 d-flex flex-column justify-content-center align-items-center">
              <div class="card-stats py-4">
                <div class="card-stats-items d-flex justify-content-center">
                  <div class="card-stats-item text-center">
                    <div class="card-stats-item-count">{{$jumlah}}</div>
                    <div class="card-stats-item-label">Total Task</div>
                  </div>
                  <div class="card-stats-item text-center">
                    <div class="card-stats-item-count">{{$pending}}</div>
                    <div class="card-stats-item-label">Pending</div>
                  </div>
                  <div class="card-stats-item text-center">
                    <div class="card-stats-item-count">{{$complete}}</div>
                    <div class="card-stats-item-label">Completed</div>
                  </div>
                </div>
              </div>
              <div class="card-wrap text-center mb-4">
                <div class="card-header">
                  <h3>Balance</h3>
                </div>
                <div class="card-body">
                  {{'Rp. ' . number_format(floatval($totaljasa), 0, ',', '.')}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3>{{$title}} Table</h3>
        </div>
        <div class="card-body px-4">
          <div class="table-responsive">
            <table class="table table-striped table-md" id="myTable">
              <thead>
                <tr>
                  <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Jenis Layanan</th>
                                    <th>Jenis Jasa</th>
                                    <th>Nama Pasien</th>
                                    <th>Tarif Jasa</th>
                                    <th>Task Bulan</th>
                                    <th>Task Selesai</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                </tr>
              </thead>
              <tbody>
                @php $no =1; @endphp 
                @foreach ($history as $item)
                <tr>
                    <td>{{$no++}}.</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->medis->jenis_layanan}}</td>
                    <td>{{$item->medis->jenis_jasa}}</td>
                    <td>{{$item->pasien->nama_pasien}}</td>
                    <td>{{'Rp.' . number_format(floatval($item->tarif_jasa), 0, ',', '.')}}</td>
                    <td>{{ date('F Y', strtotime($item->created_at)) }}</td>
                    <td>{{ date('F Y', strtotime($item->updated_at)) }}</td>
                    <td><div class="badge badge-pill badge-success mb-1 float-right">Completed</div></td>
                    <td>
                        <a href="{{route('daftar.tugas.delete.user',$item->id)}}" onclick="return confirm('Yakin akan menghapus Data ?')" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash"> Hapus</i>
                        </a>

                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right">
          <nav class="d-inline-block">
            <ul class="pagination mb-0" id="pagination"></ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Cari Data {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('daftar.tugas.cari.user',$history->first()->user_id)}}" method="get">
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cari</button>
                    </div>
                </form>
            </div>
          </div>
        </div>

<script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Ganti angka 1 dengan indeks kolom yang sesuai
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
    }
</script>

<style>
.card-body {
    position: relative;
}

.buttons {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
@endsection