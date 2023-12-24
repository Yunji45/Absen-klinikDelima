@extends('template.layout.app.main') @section('tabel')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

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
                                <caption>** Klik Foto Untuk Melihat Bukti</caption>

                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama Petugas</th>
                                    <th scope="col" class="text-center">No_HC</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Foto Kegiatan</th>
                                    <th scope="col" class="text-center">Jenis Layanan</th>
                                    <th scope="col" class="text-center">Jenis Jasa</th>
                                    <th scope="col" class="text-center">Tarif Jasa</th>
                                    <th scope="col" class="text-center">Tanggal</th>
                                    <th scope="col" class="text-center">Ceklis Tindakan</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp 
                                @foreach ($care as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td scope="col" class="text-center"> 
                                        {{ $item->user->name }}
                                    </td>
                                    <td scope="col" class="text-center">{{$item->No_HC}}</td>
                                    <td scope="col" class="text-center">{{$item->nama_pasien}}</td>
                                    <td scope="col" class="text-center">
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#gambarModal{{ $item->id }}">
                                            <img src="{{ asset('storage/homecare/' . $item->foto) }}" alt="Foto" style="width: 30px; height: 30px;">
                                        </button>
                                    </td>
                                    <td scope="col" class="text-center">{{$item->jenis_layanan}}</td>
                                    <td scope="col" class="text-center">{{$item->jenis_jasa}}</td>
                                    <td scope="col" class="text-center">{{'Rp.' . number_format(floatval($item->tarif_jasa), 0, ',', '.')}}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($item->bulan)) }}</td>
                                    <td scope="col" class="text-center">
                                    <a
                                            href="{{ $item->ceklis_tindakan == 'Ya' ? '#' : '/opr-medis/tindakan/' . $item->id }}"
                                            onclick="return @if ($item->ceklis_tindakan == 'Ya') confirm('Sudah completed Mas/Mba !!') @else true @endif"
                                            class="btn btn-sm @if ($item->ceklis_tindakan == 'Ya') bg-primary @else btn-warning @endif">
                                            @if ($item->ceklis_tindakan == 'Ya')
                                            <strong style="color: white;">Sudah</strong>
                                            @else
                                            <strong>Ceklis</strong>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('opr.medis.edit',$item->id)}}" onclick="return confirm('Yakin akan di edit?')" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>

                                    <a href="{{route('opr.medis.delete',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
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
                    <form action="{{route('home.care.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <h5 class="mb-3">{{ date('l, d F Y') }}</h5>

                            <div class="form-group row" id="name">
                                <label for="bulan" class="col-form-label col-sm-3">Bulan</label>
                                <div class="col-sm-9">
                                    <input type="date" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror">
                                    @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="user_id" class="col-form-label col-sm-3">Nama Petugas</label>
                                <div class="col-sm-9">
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Nama Petugas</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="No_RM" class="col-form-label col-sm-3">No HC</label>
                                <div class="col-sm-9">
                                    <input type="text" name="No_HC" id="No_HC" class="form-control @error('No_HC') is-invalid @enderror" placeholder="Masukkan No HC">
                                    @error('No_HC') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="nama_pasien" class="col-form-label col-sm-3">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror" placeholder="Masukkan Nama Pasien">
                                    @error('nama_pasien') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="foto" class="col-form-label col-sm-3">Foto</label>
                                <div class="col-sm-9">
                                    <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" required>
                                    @error('foto') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="jenis_layanan" class="col-form-label col-sm-3">Jenis Layanan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control @error('jenis_layanan') is-invalid @enderror" placeholder="Masukkan Jenis Layanan">
                                    @error('jenis_layanan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="jenis_jasa" class="col-form-label col-sm-3">Jenis Jasa</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jenis_jasa" id="jenis_jasa" class="form-control @error('jenis_jasa') is-invalid @enderror" placeholder="Masukkan Jenis Jasa">
                                    @error('jenis_jasa') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="UMK">
                                <label for="tarif_jasa" class="col-form-label col-sm-3">Tarif Jasa</label>
                                <div class="col-sm-9">
                                    <input type="number" name="tarif_jasa" id="tarif_jasa" class="form-control @error('tarif_jasa') is-invalid @enderror" placeholder="Masukkan Tarif Jasa">
                                    @error('tarif_jasa') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (isset($item) && $item && $item->foto)
    <div class="modal fade" id="gambarModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('storage/homecare/' . $item->foto) }}" class="img-fluid" alt="Foto">
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div> -->
            </div>
        </div>
    </div>
@else
    <!-- Tampilkan pesan atau elemen lain jika tidak ada data atau foto -->
    <p scope="col" class="text-center">Tidak ada data atau foto tersedia untuk ditampilkan.</p>
@endif





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
<!-- Bootstrap JS (Gunakan CDN atau tambahkan sendiri) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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