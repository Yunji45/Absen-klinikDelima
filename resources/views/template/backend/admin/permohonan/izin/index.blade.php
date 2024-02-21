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
                            <form action="{{route('search.cuti')}}" method="get">
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
                                    <th scope="col" class="text-center">Jenis Izin</th>
                                    <th scope="col" class="text-center">Tanggal Mulai</th>
                                    <th scope="col" class="text-center">Tanggal Berakhir</th>
                                    <th scope="col" class="text-center">Alasan</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                @php $no =1; @endphp @foreach ($cuti as $item)
                                <tr>
                                    <td class="text-center">{{$no++}}.</td>
                                    <td class="text-center">{{$item->user->name}}</td>
                                    <td class="text-center">{{$item->jenis_izin}}</td>
                                    <td class="text-center">{{$item->tanggal_mulai}}</td>
                                    <td class="text-center">{{$item->tanggal_berakhir}}</td>
                                    <td class="text-center">{{$item->alasan}}</td>
                                    <td class="text-center">{{$item->status}}</td>
                                    <td class="text-center">
                                        <a href="{{ $item->status == 'approve' ? '#' : '/VerifikasiIzin/' . $item->id . '/berhasil' }}"
                                            onclick="return @if ($item->status == 'approve') confirm('Sudah Di Approve Mas/Mba !!') @else true @endif"
                                            class="btn btn-sm @if ($item->status == 'approve') bg-success @else btn-danger @endif">
                                            @if ($item->status == 'approve')
                                                <i class="fas fa-unlock-alt"></i><strong> Confirmed</strong>
                                            @else
                                                <i class="fas fa-lock"></i><strong> Verifikasi</strong>
                                            @endif
                                        </a>
                                        <a href="{{route('delete.izin.cuti',$item->id)}}" class="btn btn-sm btn-primary" title="Detail User"><i class="fas fa-trash"></i> Reject</a>
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
                    <h5 class="modal-title" id="kehadiranLabel">Form Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('data.izin.adm') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="user_id" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-form-label col-sm-3">Jenis </label>
                            <div class="col-sm-9">
                                <select class="form-control @error('jenis_izin') is-invalid @enderror" name="jenis_izin" id="jenis_izin">
                                    <option value="sakit">Sakit</option>
                                    <option value="izin">Izin</option>
                                    <option value="cuti_tahunan">Cuti Tahunan</option>
                                    <option value="cuti_bersama">Cuti Bersama</option>
                                    <option value="cuti_besar">Cuti Besar</option>
                                    <option value="cuti_melahirkan">Cuti Melahirkan</option>
                                </select>
                                @error('keterangan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="tanggal_mulai">
                            <label for="tanggal_mulai" class="col-form-label col-sm-3">Mulai</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                @error('tanggal_mulai') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="tanggal_berakhir">
                            <label for="tanggal_berakhir" class="col-form-label col-sm-3">Berakhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" class="form-control @error('tanggal_berakhir') is-invalid @enderror">
                                @error('tanggal_berakhir') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="alasan">
                            <label for="alasan" class="col-form-label col-sm-3">Alasan</label>
                            <div class="col-sm-9">
                                <textarea name="alasan" rows="4" class="form-control @error('tanggal_berakhir') is-invalid @enderror" required></textarea>
                                @error('alasan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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