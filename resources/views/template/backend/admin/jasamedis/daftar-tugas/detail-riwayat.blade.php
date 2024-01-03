@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header">
        <h1>{{$title}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">{{$title}}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{$jumlah}}</div>
                      <div class="card-stats-item-label">Total Task</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{$pending}}</div>
                      <div class="card-stats-item-label">Pending</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{$complete}}</div>
                      <div class="card-stats-item-label">Completed</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Balance</h4>
                  </div>
                  <div class="card-body">
                  {{'Rp. ' . number_format(floatval($totaljasa), 0, ',', '.')}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h4 class="d-inline"> Detail Rekap Jasa Medis / Layanan</h4>
                  <div class="card-header-action">
                    <a href="{{route('daftar.tugas.riwayat')}}" class="btn btn-danger"><i class="fas fa-arrow-left"> Back</i></a>
                  </div>
                  <div class="card-header-form">
                                <div class="input-group">
                                <input type="date" class="form-control" placeholder="Search By Nama">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                </div>
                            
                        </div>
                </div>
                <div class="card-body">             
                  <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama Petugas</th>
                                    <th scope="col" class="text-center">Jenis Layanan</th>
                                    <th scope="col" class="text-center">Jenis Jasa</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Tarif Jasa</th>
                                    <th scope="col" class="text-center">Task Bulan</th>
                                    <th scope="col" class="text-center">Task Selesai</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Detail</th>
                                </tr>
                                @php $no =1; @endphp 
                                @foreach ($history as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td scope="col" class="text-center">{{$item->user->name}}</td>
                                    <td scope="col" class="text-center">{{$item->medis->jenis_layanan}}</td>
                                    <td scope="col" class="text-center">{{$item->medis->jenis_jasa}}</td>
                                    <td scope="col" class="text-center">{{$item->pasien->nama_pasien}}</td>
                                    <td scope="col" class="text-center">{{'Rp.' . number_format(floatval($item->tarif_jasa), 0, ',', '.')}}</td>
                                    <td scope="col" class="text-center">{{ date('F Y', strtotime($item->created_at)) }}</td>
                                    <td scope="col" class="text-center">{{ date('F Y', strtotime($item->updated_at)) }}</td>
                                    <td><div class="badge badge-pill badge-success mb-1 float-right">Completed</div></td>
                                    <td scope="col" class="text-center">
                                        <a href="{{route('daftar.tugas.delete.user',$item->user_id)}}" onclick="return confirm('Yakin akan menghapus Data ?')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"> Hapus</i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>



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