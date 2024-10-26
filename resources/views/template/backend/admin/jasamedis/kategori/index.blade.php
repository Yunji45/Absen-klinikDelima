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
           <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Layanan">
           <div class="input-group-btn">
               <button class="btn btn-primary"><i class="fas fa-search"></i></button>
           </div>
           </div>
          </div>
       </div>
       <div class="card-body px-4">
       <div class="d-flex justify-content-end mb-4">
        <a href="" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#kehadiran">
            <i class="fa fa-plus">
                </i> Add
        </a>

        <a href="" class="btn btn-outline-danger mr-2">
            <i class="fa fa-download">
                </i> PDF
        </a>
        <a href="" class="btn btn-outline-warning mr-2" data-toggle="modal" data-target="#import">
            <i class="fa fa-download">
                </i> Import Excel
        </a>
        <a href="{{route('kategori.jasa.excel')}}" class="btn btn-outline-success mr-2">
            <i class="fa fa-download">
                </i> Eksport Excel
        </a>
       </div>
         <div class="table-responsive">
           <table class="table table-striped table-md" id="myTable">
             <thead>
               <tr>
                <th>No</th>
                <th>Jenis Layanan</th>
                <th>Jenis Jasa</th>
                <th>Kode Layanan</th>
                <th>Tarif Jasa</th>
                <th>Action</th>
               </tr>
             </thead>
             <tbody>
                @php $no =1; @endphp 
                                @foreach ($kategori as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->jenis_layanan}}</td>
                                    <td>{{$item->jenis_jasa}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>{{'Rp.' . number_format(floatval($item->tarif_jasa), 0, ',', '.')}}</td>
                                    <td>
                                        <a href="{{route('kategori.jasa.edit',$item->id)}}" onclick="return confirm('Yakin akan di edit?')" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>

                                    <a href="{{route('kategori.jasa.delete',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-outline-danger btn-sm">
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
                <h5 class="modal-title" id="kehadiranLabel">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('kategori.jasa.save')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Jenis Layanan</label>
                        <div class="col-sm-9">
                            <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Jenis Layanan">
                            @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Jenis Jasa</label>
                        <div class="col-sm-9">
                            <input type="text" name="jenis_jasa" id="jenis_jasa" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Jenis Jasa">
                            @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Tarif Jasa</label>
                        <div class="col-sm-9">
                            <input type="number" name="tarif_jasa" id="tarif_jasa" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Tarif Jasa">
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
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">IMPORT DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('kategori.jasa.import') }}" method="POST" enctype="multipart/form-data">
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