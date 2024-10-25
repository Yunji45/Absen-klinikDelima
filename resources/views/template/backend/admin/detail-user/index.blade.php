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
           <a href="" class="btn btn-outline-success">
            <i class="fa fa-download">
              </i> Excel
        </a>
       </div>
         <div class="table-responsive">
           <table class="table table-striped table-md" id="myTable">
             <thead>
               <tr>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>TTL</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Jabatan</th>
                    <th> Hp</th>
                    <th>Terakhir Update</th>
                    <th>Action</th>
                </tr>
               </tr>
             </thead>
             <tbody>
                @php $no =1; @endphp @foreach ($data as $item)
                <tr>
                    <td class="text-center">{{$no++}}.</td>
                    <td class="text-center">{{$item->user->name}}</td>
                    <td scope="col" class="text-center">{{$item->email}}</td>
                    <td scope="col" class="text-center">{{$item->place_birth}}, {{$item->date_birth}}</td>
                    <td scope="col" class="text-center">{{$item->gender}}</td>
                    <td scope="col" class="text-center">{{$item->religion}}</td>
                    <td scope="col" class="text-center">{{$item->position}}</td>
                    <td scope="col" class="text-center">{{$item->phone}}</td>
                    <td scope="col" class="text-center">{{ $item->updated_at->format('d-m-Y') }}</td>
                    <td>
                    <a href="{{route('detail.info.admin',$item->id)}}" onclick="return confirm('Yakin akan ingin melihat Data?')" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye"> Lihat</i>
                        </a>
                        <a href="{{route('detail.edit.admin',$item->id)}}" onclick="return confirm('Yakin akan di edit?')" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-edit"> Edit</i>
                        </a>

                    <a href="{{route('delete.pegawai.admin',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-outline-danger btn-sm">
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