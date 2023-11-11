@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header">
        <h1>Realisasi Kinerja KPI</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">{{$title}}</div>
        </div>
    </div>
    <div class="section-header">
        <button
            type="button"
            class="btn btn-primary dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="fa fa-plus"></i>
            Add
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('kpi.form.create')}}">Add Normal</a>
            <a class="dropdown-item" href="" data-toggle="modal" data-target="#kehadiran">Add Multiple</a>
        </div>
        <!-- <a href="{{route('kpi.form.create')}}" class="btn btn-primary">
            <i class="fa fa-plus">
                Add</i>
        </a> -->
        <a href="" class="btn btn-danger">
            <i class="fa fa-download">
                </i> Pdf
        </a>
        <a href="" class="btn btn-success">
            <i class="fa fa-download">
                </i> Excel
        </a>
        <a href="" class="btn btn-warning">
            <i class="fa fa-refresh fa-spin">
                </i> Update Target
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
                            <form action="{{route('search.realisasi')}}" method="get">
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
                                    <th scope="col" class="text-center">Pendaftaran</th>
                                    <th scope="col" class="text-center">Poli</th>
                                    <th scope="col" class="text-center">Farmasi</th>
                                    <th scope="col" class="text-center">Kasir</th>
                                    <th scope="col" class="text-center">Home care</th>
                                    <th scope="col" class="text-center">BPJS</th>
                                    <th scope="col" class="text-center">Khitanan</th>
                                    <th scope="col" class="text-center">Rawat Inap</th>
                                    <th scope="col" class="text-center">Persalinan</th>
                                    <th scope="col" class="text-center">Laboratorium</th>
                                    <th scope="col" class="text-center">Umum</th>
                                    <th scope="col" class="text-center">Visite Dokter</th>
                                    <th scope="col" class="text-center">Date</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp @foreach ($target as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td class="text-center">{{$item->user->name}}</td>
                                    <td class="text-center">{{$item->c_daftar}}</td>
                                    <td class="text-center">{{$item->c_poli}}</td>
                                    <td class="text-center">{{$item->c_farmasi}}</td>
                                    <td class="text-center">{{$item->c_kasir}}</td>
                                    <td class="text-center">{{$item->c_care}}</td>
                                    <td class="text-center">{{$item->c_bpjs}}</td>
                                    <td class="text-center">{{$item->c_khitan}}</td>
                                    <td class="text-center">{{$item->c_rawat}}</td>
                                    <td class="text-center">{{$item->c_salin}}</td>
                                    <td class="text-center">{{$item->c_lab}}</td>
                                    <td class="text-center">{{$item->c_umum}}</td>
                                    <td class="text-center">{{$item->c_visit}}</td>
                                    <td class="text-center">{{$item->bulan}}</td>
                                    <td>
                                    <a href="{{route('kpi.form.edit',$item->id)}}" onclick="return confirm('Yakin akan edit Data?')" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                    <a href="{{route('kpi.form.delete',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
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
                <form action="{{ route('kpi.realisasi.multiple') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Target</label>
                            <div class="col-sm-8">
                                <select id="target_id" name="target_id" class="form-control">
                                        <option>Pilih</option>
                                        @foreach($ach as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                </select>
                                    @error('user_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data Pada</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulantarget" id="bulantarget">
                                    <option value="">Pilih</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-8">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror">
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