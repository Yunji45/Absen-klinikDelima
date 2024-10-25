@extends('template.layout.app.main')

@section('tabel')
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css"> -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }
    </style>
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
              <div class="input-group">
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
              <div class="input-group-btn">
                  <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
              </div>
             </div>
          </div>
          <div class="card-body p-0">
          <div class="d-flex justify-content-end px-4 py-4">
             <a href="{{route('note-karyawan.create')}}" class="btn btn-outline-primary mr-2">
                          <i class="fa fa-plus">
                              Add</i>
                      </a>
                      <a href="" class="btn btn-outline-danger mr-2">
                        <i class="fa fa-download">
                            PDF</i>
                    </a>
                    <a href="" class="btn btn-outline-success mr-2">
                        <i class="fa fa-download">
                            Excel</i>
                    </a>
          </div>
            <div class="table-responsive px-3">
              <table class="table table-striped table-md" id="myTable">
                <thead>
                  <tr>
                     <th >No</th>
                                <th >Nama</th>
                                <th >Keterangan</th>
                                <th >Deskripsi</th>
                                <th >Resume</th>
                                <th >Waktu</th>
                                <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                 @php
                            $no =1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                            <td >{{$no++}}.</td>
                            <td >{{$item->user->name}}</td>
                            <td >{{$item->keterangan}}</td>
                            <td >{{$item->deskripsi}}</td>
                            <td >{{$item->resume}}</td>
                            <td >{{$item->bulan}}</td>
                            <td >
                                <a href="{{route('note-karyawan.delete',$item->id)}}" 
                                onclick="return confirm('Yakin akan dihapus?')" 
                                class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>

                                <a href="{{route('note-karyawan.edit',$item->id)}}" 
                                class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

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
                    <h5 class="modal-title" id="kehadiranLabel"> Signature-pad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <form method="POST" action="{{ route('signpad.save') }}">
                            @csrf
                            <div class="col-md-12">
                                 <label class="" for="">Name:</label>
                                 <input type="text" name="name" class="form-group" value="">
                            </div>        
                            <div class="col-md-12">
                                <label>Signature:</label>
                                <br/>
                                <div id="sig"></div>
                                <br/><br/>
                                <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                                <textarea id="signature" name="signed" style="display: none"></textarea>
                            </div>
                            <br/>
                            <button class="btn btn-primary">Save</button>
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
    const rowsPerPage = 5; // Jumlah baris per halaman
    const table = document.getElementById("myTable");
    const tbody = table.querySelector("tbody");
    const rows = tbody.querySelectorAll("tr");
    const paginationContainer = document.getElementById("pagination");

    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function displayPage(page) {
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      rows.forEach((row, index) => {
        row.style.display = (index >= start && index < end) ? "" : "none";
      });
      currentPage = page; // Update currentPage here
      updatePaginationButtons(); // Call to update pagination buttons
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
          displayPage(i); // Directly display the clicked page
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
      const activeItem = paginationContainer.children[currentPage]; // Get the current page item
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
  });

    </script>


@endsection

