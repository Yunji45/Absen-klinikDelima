@extends('template.layout.app.main') 
@section('tabel')
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
    <div class="section-header">
        
        <a href="{{route('note-karyawan.create')}}" class="btn btn-primary">
            <i class="fa fa-plus">
                Add</i>
        </a>
        <a href="" class="btn btn-danger">
            <i class="fa fa-download">
                PDF</i>
        </a>
        <a href="" class="btn btn-success">
            <i class="fa fa-download">
                Excel</i>
        </a>
        
        <div class="section-header-breadcrumb">
            <div class="input-group" style="width: 200px;">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
                <div class="input-group-append">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                </div>
            </div>
        </div>

    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
                        <div class="card-header-form">
                            <form action="{{route('note-karyawan.search')}}" method="get">
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
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Keterangan</th>
                                    <th scope="col" class="text-center">Deskripsi</th>
                                    <th scope="col" class="text-center">Resume</th>
                                    <th scope="col" class="text-center">Waktu</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php
                                $no =1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                <td class="text-center">{{$no++}}.</td>
                                <td class="text-center">{{$item->user->name}}</td>
                                <td class="text-center">{{$item->keterangan}}</td>
                                <td class="text-center">{{$item->deskripsi}}</td>
                                <td class="text-center">{{$item->resume}}</td>
                                <td class="text-center">{{$item->bulan}}</td>
                                <td class="text-center">
                                    <a href="{{route('note-karyawan.delete',$item->id)}}" 
                                    onclick="return confirm('Yakin akan dihapus?')" 
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>

                                    <a href="{{route('note-karyawan.edit',$item->id)}}" 
                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

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

</script>

@endsection