@extends('template.layout.app.main')
@section('tabel')
<section class="section">
  <div class="section-header">
    <h1>{{$title}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">{{$title}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{$title}}</h2>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <table class="table table-sm table-bordered table-white text-center">
            <form method="post" action="{{ route('kpi.save') }}">
              @csrf
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Aspek Kinerja</th>
                  <th class="text-center">(0)</th>
                  <th class="text-center">(1)</th>
                  <th class="text-center">(2)</th>
                  <th class="text-center">(3)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Pendaftaran</td>
                  <td class="text-center"><input type="checkbox" name="daftar[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="daftar[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="daftar[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="daftar[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Pemerikasaan Poli</td>
                  <td class="text-center"><input type="checkbox" name="poli[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="poli[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="poli[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="poli[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Farmasi</td>
                  <td class="text-center"><input type="checkbox" name="farmasi[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="farmasi[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="farmasi[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="farmasi[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Kasir</td>
                  <td class="text-center"><input type="checkbox" name="kasir[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="kasir[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="kasir[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="kasir[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">5.</td>
                  <td class="text-center">Home Care</td>
                  <td class="text-center"><input type="checkbox" name="care[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="care[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="care[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="care[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">6.</td>
                  <td class="text-center">BPJS</td>
                  <td class="text-center"><input type="checkbox" name="bpjs[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="bpjs[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="bpjs[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="bpjs[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">7.</td>
                  <td class="text-center">Khitanan</td>
                  <td class="text-center"><input type="checkbox" name="khitan[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="khitan[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="khitan[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="khitan[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">8.</td>
                  <td class="text-center">Rawat Inap</td>
                  <td class="text-center"><input type="checkbox" name="rawat[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="rawat[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="rawat[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="rawat[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">9.</td>
                  <td class="text-center">Persalinan</td>
                  <td class="text-center"><input type="checkbox" name="persalinan[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="persalinan[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="persalinan[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="persalinan[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">10.</td>
                  <td class="text-center">Laboratorium</td>
                  <td class="text-center"><input type="checkbox" name="lab[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="lab[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="lab[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="lab[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">11.</td>
                  <td class="text-center">Umum</td>
                  <td class="text-center"><input type="checkbox" name="umum[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="umum[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="umum[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="umum[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">12.</td>
                  <td class="text-center">Visite Dokter</td>
                  <td class="text-center"><input type="checkbox" name="visit[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="visit[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="visit[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="visit[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">13.</td>
                  <td class="text-center">Orientasi Pelayanan</td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">12.</td>
                  <td class="text-center">Akuntabel</td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">13.</td>
                  <td class="text-center">Kompeten</td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">14.</td>
                  <td class="text-center">Harmonis</td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">15.</td>
                  <td class="text-center">Loyal</td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">16.</td>
                  <td class="text-center">Adaptif</td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">17.</td>
                  <td class="text-center">Kolaboratif</td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">18.</td>
                  <td class="text-center">Kehadiran/Absen</td>
                  <td class="text-center"><input type="checkbox" name="absen[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="absen[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="absen[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="absen[]" value="3" /></td>
                </tr>

                <!-- Add more rows as needed -->
              </tbody>
            </table>
            <input type="submit" class="btn btn-success" value="Simpan Data">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
