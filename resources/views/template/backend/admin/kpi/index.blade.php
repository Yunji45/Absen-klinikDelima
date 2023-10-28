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
        <a href="{{route('kpi.tambah')}}" class="btn btn-primary">
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
                            <table class="table table-striped">
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
                                    <td class="text-center">{{$item->daftar + $item->poli + $item->farmasi + $item->kasir + $item->care + $item->bpjs +$item->rawat+$item->khitan+$item->persalinan+$item->lab+$item->umum+$item->visit }}</td>
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
                                    <a href="{{ route('kpi.delete', $item->id) }}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"> Delete</i>
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