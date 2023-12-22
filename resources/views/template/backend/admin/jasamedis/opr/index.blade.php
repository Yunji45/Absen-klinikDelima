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
                                    <th scope="col" class="text-center">Bulan</th>
                                    <th scope="col" class="text-center">No_RM</th>
                                    <th scope="col" class="text-center">Nama_Pasien</th>
                                    <th scope="col" class="text-center">Jenis_Layanan</th>
                                    <th scope="col" class="text-center">Jenis_Jasa</th>
                                    <th scope="col" class="text-center">Tarif_Jasa</th>
                                    <th scope="col" class="text-center">Nama_Petugas</th>
                                    <th scope="col" class="text-center">Ceklis_Tindakan</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp @foreach ($opr as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td class="text-center">{{$item->bulan}}</td>
                                    <td scope="col" class="text-center">{{$item->No_RM}}</td>
                                    <td scope="col" class="text-center">{{$item->nama_pasien}}</td>
                                    <td scope="col" class="text-center">{{$item->jenis_layanan}}</td>
                                    <td scope="col" class="text-center">{{$item->jenis_jasa}}</td>
                                    <td scope="col" class="text-center">{{$item->tarif_jasa}}</td>
                                    <td scope="col" class="text-center"> 
                                    @if ($item && $item->user)
        {{ $item->user->name }}
    @else
        User not available
    @endif

                                    </td>
                                    <td scope="col" class="text-center">{{ $item->ceklis_tindakan}}</td>
                                    <td>
                                    <a href="{{route('detail.info.admin',$item->id)}}" onclick="return confirm('Yakin akan ingin melihat Data?')" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"> Lihat</i>
                                        </a>
                                        <a href="{{route('detail.edit.admin',$item->id)}}" onclick="return confirm('Yakin akan di edit?')" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>

                                    <a href="{{route('delete.pegawai.admin',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
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
        <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kehadiranLabel">{{$title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <div class="modal-body">
                            <h5 class="mb-3">{{ date('l, d F Y') }}</h5>

                            <div class="form-group row" id="name">
                                <label for="jam_masuk" class="col-form-label col-sm-3">Bulan</label>
                                <div class="col-sm-9">
                                    <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror">
                                    @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">No RM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="No_RM" id="No_RM" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan No RM">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Pasien">
                                    @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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
                            <div class="form-group row" id="UMK">
                                <label for="UMK" class="col-form-label col-sm-3">Nama Petugas</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_petugas" id="nama_petugas" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan No RM">
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