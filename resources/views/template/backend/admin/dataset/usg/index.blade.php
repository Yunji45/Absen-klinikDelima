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
            <form action="{{route('usg.cari')}}" method="get">
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
       <div class="d-flex justify-content-end mb-4">
           <a href="" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#kehadiran">
               <i class="fa fa-plus">
                 </i> Add
           </a>
           <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#import">
            <i class="fa fa-download">
              </i> Import Excel
        </a>
       </div>
         <div class="table-responsive">
           <table class="table table-striped table-md" id="myTable">
             <thead>
               <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>No RM</th>
                    <th>Jenis Kelamin</th>
                    <th>Poli</th>
                    <th>Tgl.Kunjungan</th>
                    <th>Alamat</th>
                    <th>Action</th>
               </tr>
             </thead>
             <tbody>
                @php $no =1; @endphp 
                @foreach ($data as $item)
                <tr>
                    <td class="text-center">{{$no++}}.</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->no_rm}}</td>
                    <td>{{$item->jenis_kelamin}}</td>
                    <td>{{$item->poli}}</td>
                    <td>{{$item->tgl_kunjungan}}</td>
                    <th>{{$item->alamat}}</th>
                    <td>
                    <a href="{{route('dataset.usg.delete',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-outline-danger btn-sm">
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
            <form action="{{route('dataset.usg.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" class="form-control @error('name') is-invalid @enderror">
                            @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">No RM</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_rm" id="no_rm" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan No RM">
                            @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Nama Pasien</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Pasien">
                            @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="UMK">
                        <label for="UMK" class="col-form-label col-sm-3">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukan Alamat Pasien">
                            @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="kode_wilayah" class="col-form-label col-sm-3">Kode Wilayah</label>
                        <div class="col-sm-9">
                            <select name="kode_wilayah" id="kode_wilayah" class="form-control @error('kode_wilayah') is-invalid @enderror">
                                <option value="">Pilih</option>
                                @foreach($kode as $wilayah)
                                    <option value="{{ $wilayah->id }}">{{ $wilayah->kode }} - {{ $wilayah->wilayah }}</option>
                                @endforeach
                            </select>
                            @error('kode_wilayah') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                    </div> --}}

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
    <form action="{{route('dataset.usg.import')}}" method="POST" enctype="multipart/form-data">
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