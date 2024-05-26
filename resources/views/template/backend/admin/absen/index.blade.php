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
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>ON-TIME</h4>
                  </div>
                  <div class="card-body">
                  {{ $masuk }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-business-time"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TELAT</h4>
                  </div>
                  <div class="card-body">
                    {{$telat}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user-clock"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>CUTI</h4>
                  </div>
                  <div class="card-body">
                    {{$cuti}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>ALPHA</h4>
                  </div>
                  <div class="card-body">
                    {{$alpha}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-people-carry"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TUKAR JAGA</h4>
                  </div>
                  <div class="card-body">
                    {{$tukarjaga}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user-shield"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>GANTI JAGA</h4>
                  </div>
                  <div class="card-body">
                    {{$gantijaga}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-user-md"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>LEMBUR</h4>
                  </div>
                  <div class="card-body">
                    {{$lembur}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-thumbtack"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TOTAL HADIR</h4>
                  </div>
                  <div class="card-body">
                    {{$permohonan}}
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="section-header">
            <a href="" class="btn btn-danger">
                <i class="fa fa-download">
                    </i> Pdf
            </a>
            <a href="{{route('presensi.export',['tanggal' => request('tanggal', date('Y-m'))])}}" class="btn btn-success">
                <i class="fa fa-download">
                    </i> Excel
            </a>
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#import">
            <i class="fa fa-download">
                </i> Import Excel
            </a>
            <div class="section-header-breadcrumb">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#update">
                    <i class="fas fa-search">
                        </i> Cari Berdasarkan Periode
                </a>

            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
                        <div class="card-header-form">
                                <div class="input-group">
                                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Total Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$presents->count())
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data yang tersedia</td>
                                    </tr>
                                @else
                                @php $no =1; @endphp

                                    @foreach ($presents as $present)
                                        <tr>
                                            <th>{{ $no++ }}.</th>
                                            <td><a href="{{ route('users.show',$present->user) }}" class="text-danger">{{ $present->user->nik }}</a></td>
                                            <td>{{ $present->user->name }}</td>
                                            <td>{{$present->tanggal}}</td>
                                            <td>{{ $present->keterangan }}</td>
                                            @if ($present->jam_masuk)
                                                <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                                            @else
                                                <td>-</td>
                                            @endif  
                                            @if($present->jam_keluar)
                                                <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                                                <td>
                                                    <!-- @if (strtotime($present->jam_keluar) <= strtotime($present->jam_masuk))
                                                        {{ 21 - (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) }}
                                                    @else
                                                        @if (strtotime($present->jam_keluar) >= strtotime(config('absensi.jam_pulang') . ' +2 hours'))
                                                            {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 3 }}
                                                        @else
                                                            {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 1 }}
                                                        @endif
                                                    @endif -->
                                                    @php
                                                        $jamMasuk = \Carbon\Carbon::parse($present->jam_masuk);
                                                        $jamKeluar = \Carbon\Carbon::parse($present->jam_keluar);
                                                        $totalJam = $jamMasuk->diffInHours($jamKeluar);
                                                    @endphp
                                                    {{ $totalJam }}
                                                </td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('presensi.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>PILIH FILE</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success">IMPORT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Cari Data {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kehadiran.search') }}" method="get">
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="tanggal" class="col-form-label">By Date:</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                            </div>
                            <div class="col-md-4">
                                <label for="start_date" class="col-form-label">Start Date:</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="col-form-label">End Date:</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
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