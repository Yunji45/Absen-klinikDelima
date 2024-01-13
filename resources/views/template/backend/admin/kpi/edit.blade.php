@extends('template.layout.app.main')
@section('tabel')
<section class="section">
  <div class="section-header">
    <h1>KPI Mastery Targets</h1>
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
            <form method="post" action="{{route('kpi.update',$kpi->id)}}">
              @csrf
              <div class="row">
                  <div class="form-group col-md-7 col-12">
                    <p class="text-start col-sm-6"> <strong>PEGAWAI YANG DI NILAI</strong></p>
                      <label for="user_id" class="col-form-label col-sm-3">Nama Pegawai</label>
                      <div class="col-sm-8">
                          <select
                              class="form-control @error('user_id') is-invalid @enderror"
                              name="user_id"
                              id="user_id">
                              <option value="{{$kpi->user_id}}">{{$kpi->user->name}}</option>
                              @foreach($user as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                          </select>
                          @error('user_id')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                      <label for="div" class="col-form-label col-sm-3">Jabatan Pegawai</label>
                      <div class="col-sm-8">
                          <select
                              class="form-control @error('jabatan') is-invalid @enderror"
                              name="jabatan"
                              id="jabatan">
                              <option value="{{$kpi->jabatan}}">{{$kpi->jabatan}}</option>
                              <option value="DOKTER">DOKTER</option>
                              <option value="PERAWAT">PERAWAT</option>
                              <option value="BIDAN">BIDAN</option>
                              <option value="NUTRISIONIS">NUTRISIONIS</option>
                              <option value="PELAKSANA GIZI">PELAKSANA GIZI</option>
                              <option value="ADMIN">ADMIN</option>
                              <option value="APOTEKER">APOTEKER</option>
                              <option value="ASISTEN APOTEKER">ASISTEN APOTEKER</option>
                              <option value="ANALIS">ANALIS</option>
                              <option value="TENAGA K3">TENAGA K3</option>
                              <option value="SECURITY">SECURITY</option>
                              <option value="PROGRAMMER">Programmer</option>
                          </select>
                          @error('jabatan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                      <label for="div" class="col-form-label col-sm-3">Divisi Pegawai</label>
                      <div class="col-sm-8">
                          <select
                              class="form-control @error('div') is-invalid @enderror"
                              name="div"
                              id="div">
                              <option value="{{$kpi->div}}">{{$kpi->div}}</option>
                              <option value="GENERAL MANAGER">GENERAL MANAGER</option>
                              <option value="MANDIV.SUMBERDAYA">MANDIV.SUMBERDAYA</option>
                              <option value="MANDIV.LAYANAN">MANDIV.LAYANAN</option>
                              <option value="DIV.PERSALINAN">DIV.PERSALINAN</option>
                              <option value="DIV.POLI KLINIK">DIV.POLI KLINIK</option>
                              <option value="DIV.EMERGENCY">DIV.EMERGENCY</option>
                              <option value="DIV.RAWAT INAP">DIV.RAWAT INAP</option>
                              <option value="DIV.NUTRISIONIS">DIV.NUTRISIONIS</option>
                              <option value="DIV.FRONT OFFICE">DIV.FRONT OFFICE</option>
                              <option value="DIV.FARMASI">DIV.FARMASI</option>
                              <option value="DIV.LABORATORIUM">DIV.LABORATORIUM</option>
                              <option value="DIV.HOME CARE">DIV.HOME CARE</option>
                              <option value="SUBDIV.KEUANGAN">SUBDIV.KEUANGAN</option>
                              <option value="SUBDIV.SDM & ADM">SUBDIV.SDM & ADM</option>
                              <option value="ADM BPJS & REKAM MEDIS">ADM BPJS & REKAM MEDIS</option>
                              <option value="SUBDIV.LOGISTIK">SUBDIV.LOGISTIK</option>
                              <option value="SUBDIV.K3">SUBDIV.K3</option>
                              <option value="Software Enginer">Software Enginer</option>
                          </select>
                          @error('div')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                      <label for="div" class="col-form-label col-sm-3">Jumlah Ceklist</label>
                      <div class="col-sm-8" >
                      <input type="number" name="target" id="target" class="form-control @error('target') is-invalid @enderror" placeholder="jangan di isi. biarkan saja !!">
                          @error('target')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group col-md-5 col-12">
                    <p class="text-start col-sm-6" > <strong>ATASAN YANG MENILAI</strong></p>
                      <label for="nama_atasan" class="col-form-label col-sm-6">Nama Atasan</label>
                      <div class="col-sm-12">
                          <select
                              class="form-control @error('nama_atasan') is-invalid @enderror"
                              name="nama_atasan"
                              id="nama_atasan">
                              <option value="{{$kpi->nama_atasan}}">{{$kpi->nama_atasan}}</option>
                              @foreach($user as $item)
                              <option value="{{$item->name}}">{{$item->name}}</option>
                              @endforeach
                          </select>
                          @error('nama_atasan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                      <label for="div" class="col-form-label col-sm-6">Jabatan Atasan</label>
                      <div class="col-sm-12">
                          <select
                              class="form-control @error('jabatan') is-invalid @enderror"
                              name="jabatan_atasan"
                              id="jabatan_atasan">
                              <option value="{{$kpi->jabatan_atasan}}">{{$kpi->jabatan_atasan}}</option>
                              <option value="DOKTER">DOKTER</option>
                              <option value="PERAWAT">PERAWAT</option>
                              <option value="BIDAN">BIDAN</option>
                              <option value="NUTRISIONIS">NUTRISIONIS</option>
                              <option value="PELAKSANA GIZI">PELAKSANA GIZI</option>
                              <option value="ADMIN">ADMIN</option>
                              <option value="APOTEKER">APOTEKER</option>
                              <option value="ASISTEN APOTEKER">ASISTEN APOTEKER</option>
                              <option value="ANALIS">ANALIS</option>
                              <option value="TENAGA K3">TENAGA K3</option>
                              <option value="SECURITY">SECURITY</option>
                          </select>
                          @error('jabatan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                      <label for="bulan" class="col-form-label col-sm-6">Divisi Atasan</label>
                      <div class="col-sm-12">
                          <select
                              class="form-control @error('bulan') is-invalid @enderror"
                              name="div_atasan"
                              id="div_atasan">
                              <option value="{{$kpi->div_atasan}}">{{$kpi->div_atasan}}</option>
                              <option value="GENERAL MANAGER">GENERAL MANAGER</option>
                              <option value="MANDIV.SUMBERDAYA">MANDIV.SUMBERDAYA</option>
                              <option value="MANDIV.LAYANAN">MANDIV.LAYANAN</option>
                              <option value="DIV.PERSALINAN">DIV.PERSALINAN</option>
                              <option value="DIV.POLI KLINIK">DIV.POLI KLINIK</option>
                              <option value="DIV.EMERGENCY">DIV.EMERGENCY</option>
                              <option value="DIV.RAWAT INAP">DIV.RAWAT INAP</option>
                              <option value="DIV.NUTRISIONIS">DIV.NUTRISIONIS</option>
                              <option value="DIV.FRONT OFFICE">DIV.FRONT OFFICE</option>
                              <option value="DIV.FARMASI">DIV.FARMASI</option>
                              <option value="DIV.LABORATORIUM">DIV.LABORATORIUM</option>
                              <option value="DIV.HOME CARE">DIV.HOME CARE</option>
                              <option value="SUBDIV.KEUANGAN">SUBDIV.KEUANGAN</option>
                              <option value="SUBDIV.SDM & ADM">SUBDIV.SDM & ADM</option>
                              <option value="ADM BPJS & REKAM MEDIS">ADM BPJS & REKAM MEDIS</option>
                              <option value="SUBDIV.LOGISTIK">SUBDIV.LOGISTIK</option>
                              <option value="SUBDIV.K3">SUBDIV.K3</option>
                              <option value="contoh">contoh</option>
                          </select>
                          @error('div_atasan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                      <label for="div" class="col-form-label col-sm-6">Periode</label>
                      <div class="col-sm-12" >
                      <input type="text" name="bulan" id="bulan" value="{{ old('bulan', $kpi->bulan) }}" class="form-control datepicker @error('bulan') is-invalid @enderror">
                          @error('bulan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- <label for="div" class="col-form-label col-sm-6">Periode</label>
                      <div class="col-sm-12" >
                      <input type="text" name="" id="" class="form-control daterange @error('bulan') is-invalid @enderror">
                          @error('bulan')
                          <span class="invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div> -->

                  </div>
                  <div class="form-group col-md-8 col-12">
                  <p class="text-start col-sm-6"> <strong>LIST CATATAN KARYAWAN</strong></p>

                    <ol class="list-group list-group-numbered">
                      @foreach($catatan as $item)
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">{{$item->user->name}} / {{$item->bulan}}</div>
                          {{$item->deskripsi}}
                        </div>
                        @if($item->keterangan == 'Negatif')
                            <span class="badge bg-danger rounded-pill">{{$item->keterangan}}</span>
                        @elseif($item->keterangan == 'Positif')
                            <span class="badge bg-primary rounded-pill">{{$item->keterangan}}</span>
                        @else
                            <!-- Handle kondisi lain jika diperlukan -->
                        @endif                      
                      </li>
                      @endforeach
                    </ol>
                  </div>
              </div>

              <thead>
                <tr>
                  <th class="text-center bg-info">NO</th>
                  <th class="text-center bg-info">ASPEK KINERJA</th>
                  <th class="text-center bg-info">(0)</th>
                  <th class="text-center bg-info">(1)</th>
                  <th class="text-center bg-info">(2)</th>
                  <th class="text-center bg-info">(3)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>B.</strong></td>
                  <td><strong style="text-decoration: underline;">Perilaku</strong></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="text-center">13.</td>
                  <td class="text-center">Orientasi Pelayanan (ramah,cekatan,solutif)</td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="layanan[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">12.</td>
                  <td class="text-center">Akuntabel (disiplin, tanggung jawab,jujur)</td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="akuntan[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">13.</td>
                  <td class="text-center">Kompeten (terampil, mau belajar , tugas baik)</td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="kompeten[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">14.</td>
                  <td class="text-center">Harmonis (suka menolong, menghargai,Jaga kondusif)</td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="harmonis[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">15.</td>
                  <td class="text-center">Loyal (setia, jaga nama baik, jaga rahasia)</td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="loyal[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">16.</td>
                  <td class="text-center">Adaptif (kreatif, inovatif/proaktif, antusias)</td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="adaptif[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center">17.</td>
                  <td class="text-center">Kolaboratif (kerjasama tim, kompak , motivator)</td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="0" /></td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="1" /></td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="2" /></td>
                  <td class="text-center"><input type="checkbox" name="kolaboratif[]" value="3" /></td>
                </tr>
                <tr>
                  <td class="text-center"><strong>C.</strong></td>
                  <td class="text-center"><strong>Kehadiran/Absen</strong></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
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
