@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header mt-4">
         <div>
           <div class="section-header-breadcrumb">
             <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
             <div class="breadcrumb-item">{{$title}}</div>
           </div>
           <h1 class="mt-3">All Posts {{$title}}</h1>
         </div>
     </div>
     <h2 class="section-title">Posts {{$title}}</h2>
     <div class="row">
      <div class="col-12">
        <div class="card mb-0">
          <div class="card-body">
            <ul class="nav nav-pills {{ $kode === 'layout-index' ? 'active' : '' }}">
              <li class="nav-item ">
                <a class="nav-link {{ Route::currentRouteName() === 'job-vacancy.index' ? 'active' : '' }}" href="{{route('job-vacancy.index')}}">All <span class="badge badge-white">{{$count}}</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('job-vacancy.index.nakes')}}">Nakes <span class="badge badge-primary">{{$Nakes}}</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('job-vacancy.index.non-nakes')}}">Non Nakes <span class="badge badge-primary">{{$NonNakes}}</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
<div class="row mt-5">
   <div class="col-12">
     <div class="card">
       <div class="card-header">
         <h3>All Posts {{$title}}</h3>
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
        <a href="{{route('job-vacancy.create')}}" class="btn btn-outline-primary mr-2">
          <i class="fa fa-plus">
            </i> Add New
      </a>
        <select class="form-control selectric">
          <option>Action For Selected</option>
          <option>Move to Draft</option>
          <option>Move to Pending</option>
          <option>Delete Pemanently</option>
        </select>
       </div>
         <div class="table-responsive">
           <table class="table table-striped table-md" id="myTable">
             <thead>
               <tr>
                <th>No</th>
                <th>Position</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Status</th>
               </tr>
             </thead>
             <tbody>
              @php $no =1; @endphp 
              @foreach ($job as $item)
              <tr>
                <td>{{$no++}}</td>
                <td>
                  <a href="#">{{$item->position}}</a>
                </td>
                <td>{{$item->category}}
                  <div class="table-links">
                    <a href="{{route('job-vacancy.edit',$item->id)}}">Edit</a>
                    <div class="bullet"></div>
                    <a href="{{route('job-vacancy.delete',$item->id)}}" class="text-danger">Hapus</a>
                  </div>
                </td>
                <td>{{$item->bulan}}</td>
                <td><div class="badge badge-primary">Published</div></td>
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

<script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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