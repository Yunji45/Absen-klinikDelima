@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header">
        <h1>{{$title}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">{{$title}}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
                        <div class="card-header-form">
                                <div class="input-group">
                                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Nama">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                </div>
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jenis Layanan</th>
                                    <th scope="col" class="text-center">Jenis Kelamin</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Due Date</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp 
                                @foreach ($tugas as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td scope="col" class="text-center">{{$item->pasien->nama_pasien}}</td>
                                    <td scope="col" class="text-center">
                                    @if ($item->medis)
                                        {{$item->medis->jenis_layanan}}
                                    @else
                                        Tidak Ada Data
                                    @endif
                                    </td>
                                    <td scope="col" class="text-center">{{$item->pasien->jenis_kelamin}}</td>
                                    <td scope="col" class="text-center">
                                        @if ($item->ceklis == 'Ya')
                                        <div class="badge badge-pill badge-primary mb-1 float-right">Completed</div>
                                        @else
                                        <div class="badge badge-pill badge-danger mb-1 float-right">Not Finished</div>
                                        @endif
                                    </td>
                                    <td scope="col" class="text-center">{{$item->bulan}}</td>
                                    <td scope="col" class="text-center">
                                    <a
                                            href="{{ $item->ceklis == 'Ya' ? '#' : '/daftar-tugas/ceklis/' . $item->id }}"
                                            onclick="return @if ($item->ceklis == 'Ya') confirm('Sudah completed Mas/Mba !!') @else true @endif"
                                            class="btn btn-sm @if ($item->ceklis == 'Ya') bg-success @else btn-warning @endif">
                                            @if ($item->ceklis == 'Ya')
                                            <strong style="color: white;">Sudah</strong>
                                            @else
                                            <strong>Ceklis</strong>
                                            @endif
                                        </a>
                                    </td>                                    
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
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