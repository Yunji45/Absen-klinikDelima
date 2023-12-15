@extends('template.layout.app.main') 
@section('tabel')
<section class="section">
    <div class="section-header">
        <h1>Tarif Jasa Medis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">{{$title}}</div>
        </div>
    </div>
    <div class="section-header">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#kehadiran">
            <i class="fa fa-plus">
                </i> Add
        </a>

        <a href="" class="btn btn-danger">
            <i class="fa fa-download">
                </i> PDF
        </a>
        <a href="" class="btn btn-warning">
            <i class="fa fa-download">
                </i> Import Excel
        </a>
        <a href="" class="btn btn-success">
            <i class="fa fa-download">
                </i> Eksport Excel
        </a>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
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
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama Layanan</th>
                                    <th scope="col" class="text-center">Periode</th>
                                    <th scope="col" class="text-center">Jenis Layanan</th>
                                    <th scope="col" class="text-center">Jenis Jasa</th>
                                    <th scope="col" class="text-center">Tarif Jasa</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php
                                $no =1;
                                @endphp
                                @foreach ($jasa as $item)
                                <tr>
                                <td class="text-center">{{$no++}}.</td>
                                <td class="text-center">{{$item->nama_standar_opr}}</td>
                                <td class="text-center">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->start_date)->format('Y-m-d') }} s/d
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->end_date)->format('Y-m-d') }}

                                </td>
                                <td class="text-center">{{$item->jenis_layanan}}</td>
                                <td class="text-center">{{$item->jenis_jasa}}</td>
                                <td class="text-center">{{'Rp.' . number_format(floatval($item->tarif_jasa), 0, ',', '.')}}</td>
                                <td class="text-center">
                                    <a href="{{route('target.jasa.medis.delete',$item->id)}}" 
                                    onclick="return confirm('Yakin akan dihapus?')" 
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>

                                    <a href="{{route('target.jasa.medis.edit',$item->id)}}" 
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
        <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('target.jasa.medis.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Nama Layanan</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_standar_opr" id="nama_standar_opr" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Layanan">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Start Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="start_date" id="start_date" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">End Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="end_date" id="end_date" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
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