@extends('template.layout.app.main') @section('tabel')
<section class="section">
  <div class="section-header mt-4">
    <div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">{{$title}}</div>
      </div>
      <h1 class="mt-3">{{$title}}</h1>
    </div>
</div>

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #007bff, #7fcff7);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>ON-TIME</h6>
          <h1>{{$masuk}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-check" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #ffc107, #ffe08a);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>TELAT</h6>
          <h1>{{$telat}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-business-time" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #007bff, #7fcff7);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>CUTI</h6>
          <h1>{{$cuti}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-user-clock" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #dc3545, #f7999e);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>ALPHA</h6>
          <h1>{{$alpha}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-times" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #17a2b8, #73d8e3);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>TUKAR JAGA</h6>
          <h1>{{$tukarjaga}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-people-carry" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #007bff, #7fcff7);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>GANTI JAGA</h6>
          <h1>{{$gantijaga}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-user-shield" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #ffc107, #ffe08a);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>LEMBUR</h6>
          <h1>{{$lembur}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-user-md" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #28a745, #8edb9e);">
      <div class="d-flex justify-content-between mt-3">
        <div>
          <h6>TOTAL HADIR</h6>
          <h1>{{$permohonan}}</h1>
        </div>
        <div class="py-4 px-4">
          <i class="fas fa-thumbtack" style="font-size: 40px;"></i>
        </div>
      </div>  
    </div>
  </div>
</div>

     <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>{{$title}} Table</h3>
            <div class="card-header-form">
              <div class="input-group">
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
              <div class="input-group-btn">
                  <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
              </div>
             </div>
          </div>
          <div class="card-body px-4">
          <div class="d-flex justify-content-end mb-4">
            <a href="" class="btn btn-outline-danger mr-2">
              <i class="fa fa-download">
                  </i> Pdf
          </a>
          <a href="{{route('presensi.export',['tanggal' => request('tanggal', date('Y-m'))])}}" class="btn btn-outline-success mr-2">
              <i class="fa fa-download">
                  </i> Excel
          </a>
          <a href="" class="btn btn-outline-warning mr-2" data-toggle="modal" data-target="#import">
          <i class="fa fa-download">
              </i> Import Excel
          </a>
          <a href="" class="btn btn-primary" data-toggle="modal" data-target="#update">
                    <i class="fas fa-search">
                        </i> Cari Berdasarkan Periode
                </a>
          </div>
            <div class="table-responsive">
              <table class="table table-striped table-md" id="myTable">
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
                      <td colspan="8" class="text-center">Tidak ada data yang tersedia</td>
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
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              <ul class="pagination mb-0" id="pagination"></ul>
            </nav>
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

    function previewUser(userId) {
              alert('Preview User ID: ' + userId);
            } 

            document.addEventListener("DOMContentLoaded", function() {
              const rowsPerPage = 10;
              const table = document.getElementById("myTable");
              const tbody = table.querySelector("tbody");
              const rows = tbody.querySelectorAll("tr");
              const paginationContainer = document.getElementById("pagination");

              if (rows.length > 0) {
                  let currentPage = 1;
                  const totalPages = Math.ceil(rows.length / rowsPerPage);

                  function displayPage(page) {
                      const start = (page - 1) * rowsPerPage;
                      const end = start + rowsPerPage;
                      rows.forEach((row, index) => {
                          row.style.display = (index >= start && index < end) ? "" : "none";
                      });
                      currentPage = page;
                      updatePaginationButtons();
                  }

                  function setupPagination() {
                      paginationContainer.innerHTML = ""; 
                      const prevLi = document.createElement("li");
                      prevLi.className = "page-item" + (currentPage === 1 ? " disabled" : "");
                      prevLi.innerHTML = '<a class="page-link" href="#" id="prev"><i class="fas fa-chevron-left"></i></a>';
                      prevLi.addEventListener("click", function(e) {
                          e.preventDefault();
                          if (currentPage > 1) {
                              currentPage--;
                              displayPage(currentPage);
                          }
                      });
                      paginationContainer.appendChild(prevLi);

                      for (let i = 1; i <= totalPages; i++) {
                          const li = document.createElement("li");
                          li.className = "page-item" + (i === currentPage ? " active" : "");
                          li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                          li.addEventListener("click", function(e) {
                              e.preventDefault();
                              displayPage(i);
                          });
                          paginationContainer.appendChild(li);
                      }

                      const nextLi = document.createElement("li");
                      nextLi.className = "page-item" + (currentPage === totalPages ? " disabled" : "");
                      nextLi.innerHTML = '<a class="page-link" href="#" id="next"><i class="fas fa-chevron-right"></i></a>';
                      nextLi.addEventListener("click", function(e) {
                          e.preventDefault();
                          if (currentPage < totalPages) {
                              currentPage++;
                              displayPage(currentPage);
                          }
                      });
                      paginationContainer.appendChild(nextLi);
                  }

                  function updatePaginationButtons() {
                      const pageItems = paginationContainer.getElementsByClassName("page-item");
                      for (let item of pageItems) {
                          item.classList.remove("active");
                      }
                      const activeItem = paginationContainer.children[currentPage];
                      if (activeItem) {
                          activeItem.classList.add("active");
                      }

                      const prevButton = document.getElementById("prev");
                      const nextButton = document.getElementById("next");
                      prevButton.parentElement.classList.toggle("disabled", currentPage === 1);
                      nextButton.parentElement.classList.toggle("disabled", currentPage === totalPages);
                  }

                  setupPagination();
                  displayPage(currentPage);
              } else {
                  paginationContainer.style.display = "none";
              }
          });
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