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

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
                        <div class="card-header-form">
                            <div class="buttons">
                                <a href="{{route('kpi.form.create')}}" class="btn btn-primary">
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

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
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
                                    <a href="{{route('kpi.form.delete',$item->id)}}" onclick="return confirm('Yakin akan dihapus?')" class="btn btn-danger btn-sm">
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