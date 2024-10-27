@extends('template.layout.app.main')

@section('tabel')
<section class="section">
    <div class="section-header mt-4">
        <div>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">{{$title}}</div>
          </div>
          <h1 class="mt-3">{{$title}}</h1>
        </div>
      </div>

          <div class="section-header">
              <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size:16px; font-weight:bold;">Total Gaji : {{'Rp.' . number_format(floatval($total), 0, ',', '.')}}</a></div>
              </div>
          </div>

          <div class="row mt-5">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3>{{$title}} Table</h3>
                  <div class="card-header-form">
                    <form action="{{route('search.omset')}}" method="get">
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
                <div class="card-body px-4">
                <div class="d-flex justify-content-end mb-4">
                    <button type="button" class="btn btn-outline-primary mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('gaji.create') }}">Add Normal</a>
                        <a class="dropdown-item" href="{{route('multiple.gaji.create')}}">Add Multiple</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#update">GET Data Multiple</a>
                    </div>
                    <a href="{{route('gaji.download', ['bulan' => request('bulan', date('Y-m'))])}}" class="btn btn-outline-danger mr-2">
                    <i class="fa fa-download">
                        </i> PDF
                    </a>
                    <a href="{{route('gaji.download.excel', ['bulan' => request('bulan', date('Y-m'))])}}" class="btn btn-outline-success mr-2">
                        <i class="fa fa-download">
                            </i> Export to Excel
                    </a>
                </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-md" id="myTable">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pendidikan</th>
                            <th>Gaji</th>
                            <th>UMR</th>
                            <th>Masa Kerja</th>
                            <th>Index Kerja</th>
                            <th>Presentase</th>
                            <th>THP</th>
                            <th>(80%)</th>
                            <th>(20%)</th>
                            <th>Penyesuaian</th>
                            <th>Tambahan</th>
                            <th>Potongan</th>
                            <th>Invoices Transfer</th>
                            <th>Invoices Penerima</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $no =$gaji->firstItem();
                        @endphp
                        @foreach ($gaji as $item)
                        <tr>
                          <td>{{$no++}}.</td>
                          <td>{{$item->user->name}}</td>
                          <td>{{$item->pendidikan}}</td>
                          <td>{{'Rp.' . number_format(floatval($item->Gaji_akhir), 0, ',', '.')}}</td>
                          <td>{{$item->UMR->Rp}}</td>
                          <td>{{$item->masa_kerja_karyawan}}</td>
                          <!-- <td>{{$item->user->detailpegawai->length_of_service ?? 0}}</td> -->
                          <td>{{$item->Masa_kerja}}</td>
                          <td>{{$item->index}}%</td>
                          <td>{{'Rp.' . number_format(floatval($item->THP), 0, ',', '.')}}</td>
                          <td>{{'Rp.' . number_format(floatval($item->Gaji), 0, ',', '.')}}</td>
                          <td>{{'Rp.' . number_format(floatval($item->Ach), 0, ',', '.')}}</td>
                          <td>{{'Rp.' . number_format(floatval($item->penyesuaian), 0, ',', '.')}}</td>
                          <td>{{'Rp.' . number_format(floatval($item->Bonus ?? '0'), 0, ',', '.')}}</td>
                          <td>{{'Rp.' . number_format(floatval($item->Potongan ?? '0'), 0, ',', '.')}}</td>
                          <td>
                            <a
                                href="{{ $item->status_admin == 'completed' ? '#' : '/Payroll-confirm/' . $item->id }}"
                                onclick="return @if ($item->status_admin == 'completed') confirm('Sudah completed Mas/Mba !!') @else true @endif"
                                class="btn btn-sm @if ($item->status_admin == 'completed') bg-primary @else btn-info @endif">
                                @if ($item->status_admin == 'completed')
                                <strong style="color: white;">completed</strong>
                                @else
                                <strong>Process</strong>
                                @endif
                            </a>
                          </td>
                          <td>
                            <a
                                href="{{ $item->status_penerima == 'success' ? '#' : '/Payroll-confirm-penerima/' . $item->id }}"
                                onclick="return @if ($item->status_penerima == 'success') confirm('Sudah Success Mas/Mba !!') @else true @endif"
                                class="btn btn-sm @if ($item->status_penerima == 'success') bg-warning @else btn-danger @endif">
                                @if ($item->status_penerima == 'success')
                                <strong style="color: white;">success</strong>
                                @else
                                <strong>Pending</strong>
                                @endif
                            </a>
                          </td>
                          <td>{{$item->bulan}}</td>
                          <td>
                            <a href="{{route('gaji.edit',$item->id)}}" 
                            onclick="return confirm('Yakin akan edit data ?')" 
                            class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
                            <a href="{{route('gaji.delete',$item->id)}}" 
                            onclick="return confirm('Yakin akan dihapus?')" 
                            class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i>Hapus</a>
                          </td>                        
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <nav class="d-inline-block">
                    <ul class="pagination mb-0" id="pagination"></ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel"> Insert Get Multiple {{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('gaji.get') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Ambil Data</label>
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
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Insert</label>
                            <div class="col-sm-8">
                                <input type="date" name="bulantarget" id="bulantarget" class="form-control @error('name') is-invalid @enderror">
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
@endsection