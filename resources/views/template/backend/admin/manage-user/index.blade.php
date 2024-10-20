@extends('template.layout.app.main') 
@section('tabel')

<section class="section">
  <div class="section-header mt-4">
    <div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">{{$title}}</div>
      </div>
      <h1 class="mt-3">Management User</h1>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #007bff, #7fcff7);">
          <div class="d-flex justify-content-between mt-3">
            <div>
              <h6>Total Users</h6>
              <h1>{{ $users->count() }}</h1>
            </div>
            <div class="py-4 px-4">
              <i class="fas fa-users" style="font-size: 40px;"></i>
            </div>
          </div>  
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #ff0000, #f69898);">
          <div class="d-flex justify-content-between mt-3">
            <div>
              <h6>Total Admin</h6>
              <h1>{{ $admin }}</h1>
            </div>
            <div class="py-4 px-4">
              <i class="fas fa-users" style="font-size: 40px;"></i>
            </div>
          </div>  
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="p-3 rounded text-white" style="background: linear-gradient(135deg, #ff7300, #ffbf8a);">
          <div class="d-flex justify-content-between mt-3">
            <div>
              <h6>Total Pegawai</h6>
              <h1>{{ $pegawai }}</h1>
            </div>
            <div class="py-4 px-4">
              <i class="fas fa-users" style="font-size: 40px;"></i>
            </div>
          </div>  
        </div>
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
          <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('users.create') }}" class="btn btn-outline-primary mr-2">
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Saldo Cuti</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->saldo_cuti }}</td>
                    <td>
                      <a href="{{ route('users.show', $user) }}" onclick="return confirm('Yakin akan ingin melihat Data?')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
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
  </div>
</section>

<script>
  // Fungsi Filter
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Dimulai dari 1 untuk skip header
      td = tr[i].getElementsByTagName("td")[1]; // Kolom nama
      if (td) {
        txtValue = td.textContent || td.innerText;
        tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
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
