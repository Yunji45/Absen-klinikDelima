@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header">
        <h1>Key Performance Indicator</h1>
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
            <a class="dropdown-item" href="{{route('kpi.tambah')}}">Add Normal</a>
            <a class="dropdown-item" href="" data-toggle="modal" data-target="#kehadiran">Add Multiple</a>
        </div>

        <!-- <a href="{{route('kpi.tambah')}}" class="btn btn-primary">
            <i class="fa fa-plus">
                Add</i>
        </a> -->
        <a href="" class="btn btn-danger">
            <i class="fa fa-download">
                PDF</i>
        </a>
        <a href="" class="btn btn-success">
            <i class="fa fa-download">
                Excel</i>
        </a>
        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#update">
            <i class="fa fa-refresh fa-spin">
                </i> Update Realisasi
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
                            <form action="{{route('search.kpi')}}" method="get">
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
                                    <th scope="col" class="text-center">Divisi</th>
                                    <th scope="col" class="text-center">Jumlah Ceklis</th>
                                    <th scope="col" class="text-center">Capaian Target</th>
                                    <th scope="col" class="text-center">Perilaku</th>
                                    <th scope="col" class="text-center">Absensi</th>
                                    <th scope="col" class="text-center">Nilai Total</th>
                                    <!-- <th scope="col" class="text-center">Nilai Kinerja</th> -->
                                    <!-- <th scope="col" class="text-center">Ekspektasi Kinerja</th> -->
                                    <th scope="col" class="text-center">Periode</th>
                                    <th scope="col" class="text-center">Lihat</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp @foreach ($kpi as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td class="text-center">{{$item->user->name}}</td>
                                    <td class="text-center">{{$item->div}}</td>
                                    <td class="text-center">{{$item->target}}</td>
                                    <td class="text-center">{{$item->daftar + $item->poli + $item->farmasi + $item->kasir + $item->care + $item->bpjs +$item->rawat+$item->khitan+$item->persalinan+$item->lab+$item->umum+$item->visit+$item->usg }}</td>
                                    <td class="text-center">{{$item->layanan+$item->akuntan+$item->kompeten+$item->harmonis+$item->loyal+$item->adaptif+$item->kolaboratif}}</td>
                                    <td class="text-center">{{$item->absen}}</td>
                                    <td class="text-center">{{$item->total}}</td>
                                    <!-- <td class="text-center">{{ number_format($item->total_kinerja, 2) }}</td> -->
                                    <!-- <td class="text-center">{{$item->ket}}</td> -->
                                    <td class="text-center">{{$item->bulan}}</td>
                                    <td>
                                        <a href="{{route('kpi.view',$item->id)}}" class="btn btn-info btn-sm" style="margin-right: 10px;">
                                            <i class="fas fa-eye"> Lihat</i>
                                        </a>
                                    </td>
                                    <td>
                                    <a href="{{ route('kpi.edit.evaluasi', $item->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                    <a href="{{ route('kpi.delete', $item->id) }}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
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
                    <h5 class="modal-title" id="kehadiranLabel">Form Evaluasi Multiple</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kpi.multiple') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data Realisasi Bulan</label>
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
                        <!-- <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data Realisasi Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulanreal" id="bulanreal">
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
                        </div> -->
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Simpan Evaluasi Bulan</label>
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
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Update {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kpi.update.multiple') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Update Data Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan" id="bulan">
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