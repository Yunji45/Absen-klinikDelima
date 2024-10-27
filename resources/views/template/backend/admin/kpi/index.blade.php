@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header mt-4">
        <div>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">{{$title}}</div>
          </div>
          <h1 class="mt-3">Key Performance Indicator</h1>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3>{{$title}} Table</h3>
              <div class="card-header-form">
                <form action="{{route('search.kpi')}}" method="get">
                    @csrf
                    <div class="input-group">
                    <input type="month" class="form-control" name="bulan" id="bulan" placeholder="Search Bulan" value="{{ request('bulan',date('Y-m')) }}">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                    </div>
                </form>
                
               </div>
               
            </div>
            <div class="card-body px-4">
                <div class="d-flex justify-content-end mb-4 gap-2">
                    <button
                        type="button"
                        class="btn btn-outline-primary dropdown-toggle mr-2"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        style="height: 38px;">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('kpi.tambah') }}">Add Normal</a>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#kehadiran">Add Multiple</a>
                    </div>
                
                    <a href="" class="btn btn-outline-danger mr-2" style="height: 38px;">
                        <i class="fa fa-download"></i> PDF
                    </a>
                    <a href="" class="btn btn-outline-success mr-2" style="height: 38px;">
                        <i class="fa fa-download"></i> Excel
                    </a>
                    <a href="" class="btn btn-outline-warning mr-2" data-toggle="modal" data-target="#update" style="height: 38px;">
                        <i class="fa fa-refresh fa-spin"></i> Update Realisasi
                    </a>
                    <a href="" class="btn btn-outline-danger mr-2" data-toggle="modal" data-target="#hapusdata" style="height: 38px;">
                        <i class="fas fa-trash-alt"></i> Hapus Semua Data
                    </a>
                    
                    <div class="input-group" style="width: 200px; height: 38px;">
                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
            </div>
              <div class="table-responsive">
                <table class="table table-striped table-md" id="myTable">
                  <thead>
                    <tr>
                        <th>No</th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Jumlah Ceklis</th>
                                    <th>Capaian Target</th>
                                    <th>Perilaku</th>
                                    <th>Absensi</th>
                                    <th>Nilai Total</th>
                                    <th>Nilai Kinerja</th>
                                    <th>Ekspektasi Kinerja</th>
                                    <th>Periode</th>
                                    <th>Lihat</th>
                                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no =1; @endphp @foreach ($kpi as $item)
                    <tr>
                        <td>{{$no++}}.</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->div}}</td>
                        <td>{{$item->target}}</td>
                        <td>{{$item->daftar + $item->poli + $item->farmasi + $item->kasir + $item->care + $item->bpjs +$item->rawat+$item->khitan+$item->persalinan+$item->lab+$item->umum+$item->visit+$item->usg }}</td>
                        <td>{{$item->layanan+$item->akuntan+$item->kompeten+$item->harmonis+$item->loyal+$item->adaptif+$item->kolaboratif}}</td>
                        <td>{{$item->absen}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{ number_format($item->total_kinerja, 2) }}</td>
                        <td>{{$item->ket}}</td>
                        <td>{{$item->bulan}}</td>
                        <td>
                            <a href="{{route('kpi.view',$item->id)}}" class="btn btn-info btn-sm" style="margin-right: 10px;">
                                <i class="fas fa-eye"> Lihat</i>
                            </a>
                        </td>
                        <td>
                        <a href="{{ route('kpi.edit.evaluasi', $item->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"> Edit</i>
                            </a>
                        <a href="{{ route('kpi.delete', $item->id) }}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"> Hapus</i>
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
<div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">Form Evaluasi Multiple</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kpi.multiple') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data Realisasi Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulantarget" id="bulantarget">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data Realisasi Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulanreal" id="bulanreal">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div> -->
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Simpan Evaluasi Bulan</label>
                            <div class="col-sm-8">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Update {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kpi.update.multiple') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Update Data Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="hapusdata" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Hapus {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kpi.kpi.delete-all') }}" method="get">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Hapus Data Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Hapus</button>
                    </div>
                </form>
            </div>
          </div>
        </div>

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

@endsection