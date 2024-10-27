@extends('template.layout.app.main')

@section('tabel')
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
        </div>
        <div class="card-body px-4">
        <div class="d-flex justify-content-end mb-4">
            <a href="{{route('target.kpi.create')}}" class="btn btn-outline-primary">
                <i class="fa fa-plus">
                  </i> Add
            </a>
        </div>
          <div class="table-responsive">
            <table class="table table-striped table-md" id="myTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Target</th>
                  <th>Periode</th>
                  <th>Pendaftar</th>
                  <th>Poli</th>
                  <th>Farmasi</th>
                  <th>Kasir</th>
                  <th>Home Care</th>
                  <th>Bpjs</th>
                  <th>Khitan</th>
                  <th>Rawat Inap</th>
                  <th>Persalinan</th>
                  <th>Lab</th>
                  <th>Umum</th>
                  <th>Visit Dokter</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $no =1;
                @endphp
                @foreach ($target as $item)
                <tr>
                  <td>{{$no++}}.</td>
                  <td>{{$item->name}}</td>
                  <td>{{date('m-Y', strtotime($item->start_date))}} s/d {{date('m-Y', strtotime($item->end_date))}}</td>
                  <td>{{$item->daftar}}</td>
                  <td>{{$item->poli}}</td>
                  <td>{{$item->farmasi}}</td>
                  <td>{{$item->kasir}}</td>
                  <td>{{$item->care}}</td>
                  <td>{{$item->bpjs}}</td>
                  <td>{{$item->khitan}}</td>
                  <td>{{$item->rawat}}</td>
                  <td>{{$item->salin}}</td>
                  <td>{{$item->lab}}</td>
                  <td>{{$item->umum}}</td>
                  <td>{{$item->visit}}</td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{route('target.kpi.edit',$item->id)}}" 
                        onclick="return confirm('Yakin akan edit Data ?')" 
                        class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
    
                        <a href="{{route('target.kpi.delete',$item->id)}}" 
                        onclick="return confirm('Yakin akan dihapus?')" 
                        class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i>Hapus</a>
                    </div>
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
        $(document).ready(function () {
            $("#closeModalBtn").click(function () {
            $("#kehadiran").modal("hide"); // "kehadiran" adalah ID modal Anda
        });

            // Ketika input UMK berubah
            $("#UMKInput").on("input", function () {
                // Ambil nilai dari input UMK
                var inputValue = $(this).val();

                // Hapus semua karakter selain angka
                var numericValue = inputValue.replace(/\D/g, '');

                // Format angka ke format Rupiah
                var formattedValue = formatRupiah(numericValue);

                // Set kembali nilai input dengan format Rupiah
                $(this).val(formattedValue);
            });

            // Ketika form disubmit
            $("form").submit(function (event) {
                // Ambil nilai dari input UMK
                var inputValue = $("#UMKInput").val();

                // Hapus semua karakter selain angka
                var numericValue = inputValue.replace(/\D/g, '');

                // Set kembali nilai input dengan format angka yang valid
                $("#UMKInput").val(numericValue);
                return true; // Lanjutkan proses submit form
            });

            // Fungsi untuk memformat angka ke format Rupiah
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var hasil = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + hasil;
            }
        });

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
