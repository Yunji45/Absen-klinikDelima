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
                    <a href="" class="btn btn-outline-primary" data-toggle="modal" data-target="#kehadiran">
                        <i class="fa fa-plus">
                            Add</i>
                    </a>
                    <a href="" class="btn btn-outline-danger">
                        <i class="fa fa-download">
                            PDF</i>
                    </a>
                    <a href="" class="btn btn-outline-success">
                        <i class="fa fa-download">
                            Excel</i>
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
                        <th>Jenis Permohonan</th>
                        <th>Tanggal</th>
                        <th>Pengganti</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no =1; @endphp @foreach ($permohonan as $item)
                    <tr>
                        <td class="text-center">{{$no++}}.</td>
                        <td class="text-center">{{$item->user->name}}</td>
                        <td class="text-center">{{$item->permohonan}}</td>
                        <td class="text-center">{{$item->tanggal}}</td>
                        <td class="text-center">{{$item->pengganti}}</td>
                        <td class="text-center">{{$item->alasan}}</td>
                        <td class="text-center">{{$item->status}}</td>
                        <td class="text-center">
                            <a href="{{ $item->status == 'approve' ? '#' : '/Verifikasi/' . $item->id . '/berhasil' }}"
                                onclick="return {{ $item->status == 'approve' ? 'confirm(\'Sudah Di Approve Mas/Mba !!\')' : 'true' }}"
                                class="btn btn-sm @if ($item->status == 'approve') btn-outline-success @else btn-outline-danger @endif">
                                
                                 @if ($item->status == 'approve')
                                     <i class="fas fa-unlock-alt"></i><strong> Confirmed</strong>
                                 @else
                                     <i class="fas fa-lock"></i><strong> Verifikasi</strong>
                                 @endif
                             </a>
                             
                            <a href="{{route('permohonan.delete',$item->id)}}" class="btn btn-sm btn-outline-primary" title="Detail User"><i class="fas fa-trash"></i> Reject</a>
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
                    <h5 class="modal-title" id="kehadiranLabel">Form Permohonan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('permohonan.save.adm')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="permohonan" class="col-form-label col-sm-3">Jenis Permohonan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('permohonan') is-invalid @enderror" name="permohonan" id="permohonan">
                                    <option value="ganti_jaga">Ganti Jaga</option>
                                    <option value="tukar_jaga">Tukar Jaga</option>
                                    <option value="lembur">Lembur</option>
                                </select>
                                @error('permohonan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pengganti" class="col-form-label col-sm-3">Pengganti</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('pengganti') is-invalid @enderror" name="pengganti" id="pengganti">
                                    <option value="">Tidak Ada</option>
                                    @foreach ($user as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('pengganti') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="tanggal">
                            <label for="tanggal" class="col-form-label col-sm-3">Pada Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="alasan">
                            <label for="alasan" class="col-form-label col-sm-3">Alasan</label>
                            <div class="col-sm-9">
                                <textarea name="alasan" rows="4" class="form-control @error('tanggal_berakhir') is-invalid @enderror" required></textarea>
                                @error('alasan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
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