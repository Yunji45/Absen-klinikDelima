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

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} Table</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th colspan="2" scope="col" class="text-center">Pegawai Yang Dinilai</th>
                                    <th colspan="2" scope="col" class="text-center">Atasan Yang Menilai</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">Nama :</th>
                                    <th scope="col" class="text-center">{{$kpi->user->name}}</th>
                                    <th scope="col" class="text-center">Nama :</th>
                                    <th scope="col" class="text-center">{{$kpi->nama_atasan}}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">Jabatan :</th>
                                    <th scope="col" class="text-center">{{$kpi->jabatan}}</th>
                                    <th scope="col" class="text-center">Jabatan :</th>
                                    <th scope="col" class="text-center">{{$kpi->jabatan_atasan}}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">Divisi :</th>
                                    <th scope="col" class="text-center">{{$kpi->div}}</th>
                                    <th scope="col" class="text-center">Divisi :</th>
                                    <th scope="col" class="text-center">{{$kpi->div_atasan}}</th>
                                </tr>
                            </table>
                        </div>
                        <hr class="separator">
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th rowspan="2" scope="col" class="text-center">No</th>
                                    <th rowspan="2" scope="col" class="text-center">Aspek Kinerja</th>
                                    <th colspan="3" scope="col" class="text-center">Penilaian Ekspektasi</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">Target</th>
                                    <th scope="col" class="text-center">Realisasi</th>
                                    <th scope="col" class="text-center">Poin KPI</th>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">1.</td>
                                    <td scope="col" class="text-center">Pendaftaran</td>
                                    <td scope="col" class="text-center">{{$ach->daftar}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_daftar}}</td>
                                    <td scope="col" class="text-center">{{$kpi->daftar}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">2.</td>
                                    <td scope="col" class="text-center">Pemeriksaan Poli</td>
                                    <td scope="col" class="text-center">{{$ach->poli}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_poli}}</td>
                                    <td scope="col" class="text-center">{{$kpi->poli}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">3.</td>
                                    <td scope="col" class="text-center">Farmasi</td>
                                    <td scope="col" class="text-center">{{$ach->farmasi}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_farmasi}}</td>
                                    <td scope="col" class="text-center">{{$kpi->farmasi}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">4.</td>
                                    <td scope="col" class="text-center">Kasir</td>
                                    <td scope="col" class="text-center">{{$ach->kasir}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_kasir}}</td>
                                    <td scope="col" class="text-center">{{$kpi->kasir}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">5.</td>
                                    <td scope="col" class="text-center">Home Care</td>
                                    <td scope="col" class="text-center">{{$ach->care}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_care}}</td>
                                    <td scope="col" class="text-center">{{$kpi->care}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">6.</td>
                                    <td scope="col" class="text-center">BPJS</td>
                                    <td scope="col" class="text-center">{{$ach->bpjs}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_bpjs}}</td>
                                    <td scope="col" class="text-center">{{$kpi->bpjs}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">7.</td>
                                    <td scope="col" class="text-center">Khitanan</td>
                                    <td scope="col" class="text-center">{{$ach->khitan}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_khitan}}</td>
                                    <td scope="col" class="text-center">{{$kpi->khitan}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">8.</td>
                                    <td scope="col" class="text-center">Rawat Inap</td>
                                    <td scope="col" class="text-center">{{$ach->rawat}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_rawat}}</td>
                                    <td scope="col" class="text-center">{{$kpi->rawat}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">9.</td>
                                    <td scope="col" class="text-center">Persalinan</td>
                                    <td scope="col" class="text-center">{{$ach->salin}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_salin}}</td>
                                    <td scope="col" class="text-center">{{$kpi->persalinan}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">10.</td>
                                    <td scope="col" class="text-center">Laboratorium</td>
                                    <td scope="col" class="text-center">{{$ach->lab}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_lab}}</td>
                                    <td scope="col" class="text-center">{{$kpi->lab}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">11.</td>
                                    <td scope="col" class="text-center">Umum & RT</td>
                                    <td scope="col" class="text-center">{{$ach->umum}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_umum}}</td>
                                    <td scope="col" class="text-center">{{$kpi->umum}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">12.</td>
                                    <td scope="col" class="text-center">USG</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->usg}}</td>
                                    <td scope="col" class="text-center">{{$kpi->usg}}</td>
                                </tr>

                                <tr>
                                    <td scope="col" class="text-center">13.</td>
                                    <td scope="col" class="text-center">Visite Dokter</td>
                                    <td scope="col" class="text-center">{{$ach->visit}}</td>
                                    <td scope="col" class="text-center">{{$targetkpi->r_visit}}</td>
                                    <td scope="col" class="text-center">{{$kpi->visit}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">14.</td>
                                    <td scope="col" class="text-center">Orientasi Pelayanan (ramah,cekatan,solutif)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->layanan}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">15.</td>
                                    <td scope="col" class="text-center">Akuntabel (disiplin, tanggung jawab,jujur)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->akuntan}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">16.</td>
                                    <td scope="col" class="text-center">Kompeten (terampil, mau belajar , tugas baik)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->kompeten}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">17.</td>
                                    <td scope="col" class="text-center">Harmonis (suka menolong, menghargai,Jaga kondusif)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->harmonis}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">18.</td>
                                    <td scope="col" class="text-center">Loyal (setia, jaga nama baik, jaga rahasia)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->loyal}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">19.</td>
                                    <td scope="col" class="text-center">Adaptif (kreatif, inovatif/proaktif, antusias)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->adaptif}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">20.</td>
                                    <td scope="col" class="text-center">Kolaboratif (kerjasama tim, kompak , motivator)</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">-</td>
                                    <td scope="col" class="text-center">{{$kpi->kolaboratif}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center">21.</td>
                                    <td scope="col" class="text-center">Absensi</td>
                                    <td scope="col" class="text-center">{{$psTotal}}</td>
                                    <td scope="col" class="text-center">{{$totalkehadiran}}</td>
                                    <td scope="col" class="text-center">{{$kpi->absen}}</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="text-center"></td>
                                    <td scope="col" class="text-center"><strong>TOTAL</strong></td>
                                    <td scope="col" class="text-center"></td>
                                    <td scope="col" class="text-center"></td>
                                    <td scope="col" class="text-center"><strong>{{$kpi->total}}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* .card-body {
    position: relative;
}

.buttons {
    position: absolute;
    top: 10px;
    right: 10px;
} */
.separator {
    border: 1px solid #ccc; /* Customize the border color, style, and width as needed */
    margin: 20px 0; /* Adjust the margin to control the spacing around the separator */
}

table {
            border-collapse: collapse;
            width: 100%;
        }
 
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            color: black;
        }
        th {
            background-color: rgb(19, 110, 170);
            color: white;
        }
        tr:hover {background-color: #f5f5f5;}

</style>
@endsection