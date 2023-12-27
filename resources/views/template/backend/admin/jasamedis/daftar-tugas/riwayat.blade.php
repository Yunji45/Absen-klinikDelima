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
    <div class="section-header">

        <a href="" class="btn btn-danger">
            <i class="fa fa-download">
                </i> PDF
        </a>
        <a href="" class="btn btn-success">
            <i class="fa fa-download">
                </i> Eksport Excel
        </a>
        <div class="section-header-breadcrumb">
                <a href="{{route('daftar.tugas')}}" class="btn btn-primary">
                    <i class="fas fa-search">
                        </i> Jadwal Tugas
                </a>

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
                                    <th scope="col" class="text-center">Nama Petugas</th>
                                    <th scope="col" class="text-center">Jenis Layanan</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jenis Kelamin</th>
                                    <th scope="col" class="text-center">Tarif Jasa</th>
                                    <th scope="col" class="text-center">Ceklis Tindakan</th>
                                    <th scope="col" class="text-center">Date</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp 
                                @foreach ($tugas as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td scope="col" class="text-center">{{$item->user->name}}</td>
                                    <td scope="col" class="text-center">
                                    @if ($item->medis)
                                        {{$item->medis->jenis_layanan}}
                                    @else
                                        Tidak Ada Data
                                    @endif
                                    </td>
                                    <td scope="col" class="text-center">{{$item->pasien->nama_pasien}}</td>
                                    <td scope="col" class="text-center">{{$item->pasien->jenis_kelamin}}</td>
                                    <td scope="col" class="text-center">{{$item->tarif_jasa}}</td>
                                    <td scope="col" class="text-center">
                                        {{$item->ceklis}}
                                    </td>
                                    <td scope="col" class="text-center">{{$item->bulan}}</td>
                                    <td scope="col" class="text-center">
                                        <a href="{{route('daftar.tugas.edit',$item->id)}}" onclick="return confirm('Yakin akan di edit?')" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>

                                    <a href="{{route('daftar.tugas.delete',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"> Hapus</i>
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