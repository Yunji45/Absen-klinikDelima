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
          <div class="d-flex justify-content-end mb-4 px-4">
        <a href="" class="btn btn-outline-primary" data-toggle="modal" data-target="#kehadiran">
                            <i class="fa fa-plus">
                                </i> Add
                        </a>
          </div>
            <div class="table-responsive px-3">
              <table class="table table-striped table-md" id="myTable">
                <thead>
                  <tr>
                <th>No</th>
                                <th>Nama</th>
                                <th>Signature-pad</th>
                                <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                 @foreach ($data as $item)
                                <tr >
                                  <td>{{$no++}}.</td>
                                  <td>{{$item->name}}</td>
                                  <td><img src="{{ asset('storage/signatures/' . $item->signature) }}" alt="Signature" width="100" height="50"></td>
                                  <td>
                                    <a href="{{route('signpad.delete',$item->id)}}" 
                                    onclick="return confirm('Yakin akan hapus data ?')" 
                                    class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
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
                  <h5 class="modal-title" id="kehadiranLabel">Signature Pad</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form method="POST" action="{{ route('signpad.save') }}">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                      </div>
                      <div class="form-group">
                          <label>Signature:</label>
                          <div id="sig" class="border rounded"></div>
                          <button id="clear" class="btn btn-danger btn-sm mt-2">Clear</button>
                          <textarea id="signature" name="signed" style="display: none"></textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
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
            #sig {
        width: 100%;
        height: 200px;
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
        </script>
        
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });

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
