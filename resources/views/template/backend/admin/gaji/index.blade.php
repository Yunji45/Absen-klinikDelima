@extends('template.layout.app.main')

@section('tabel')
<section class="section">
          <div class="section-header">
            <h1>Payroll</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">{{$title}}</div>
            </div>
          </div>
          <div class="section-header">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-plus"></i> Add
              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('gaji.create') }}">Add Normal</a>
                  <a class="dropdown-item" href="{{route('multiple.gaji.create')}}">Add Multiple</a>
                  <a class="dropdown-item" data-toggle="modal" data-target="#update">GET Data Multiple</a>
              </div>

              <!-- <a href="{{route('gaji.create')}}" class="btn btn-primary">
                  <i class="fa fa-plus">
                      Add</i>
              </a> -->
              <a href="{{route('gaji.download', ['bulan' => request('bulan', date('Y-m'))])}}" class="btn btn-danger">
                  <i class="fa fa-download">
                      </i> PDF
              </a>
              <a href="{{route('gaji.download.excel', ['bulan' => request('bulan', date('Y-m'))])}}" class="btn btn-success">
                  <i class="fa fa-download">
                      </i> Export to Excel
              </a>
              <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size:16px; font-weight:bold;">Total Gaji : {{'Rp.' . number_format(floatval($total), 0, ',', '.')}}</a></div>
              </div>
          </div>


          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{$title}} Table</h4>
                        <div class="card-header-form">
                            <form action="{{route('gaji.search')}}" method="get">
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
                          <th scope="col" class="text-center">Pendidikan</th>
                          <th scope="col" class="text-center">Gaji</th>
                          <th scope="col" class="text-center">UMR</th>
                          <th scope="col" class="text-center">Masa Kerja</th>
                          <th scope="col" class="text-center">Index Kerja</th>
                          <th scope="col" class="text-center">Presentase</th>
                          <th scope="col" class="text-center">THP</th>
                          <th scope="col" class="text-center">(80%)</th>
                          <th scope="col" class="text-center">(20%)</th>
                          <th scope="col" class="text-center">Penyesuaian</th>
                          <th scope="col" class="text-center">Tambahan</th>
                          <th scope="col" class="text-center">Potongan</th>
                          <th scope="col" class="text-center">Invoices Transfer</th>
                          <th scope="col" class="text-center">Invoices Penerima</th>
                          <th scope="col" class="text-center">Date</th>
                          <th scope="col" class="text-center">Action</th>
                        </tr>
                        @php
                        $no =$gaji->firstItem();
                        @endphp
                        @foreach ($gaji as $item)
                        <tr>
                          <td class="text-center">{{$no++}}.</td>
                          <td class="text-center">{{$item->user->name}}</td>
                          <td class="text-center">{{$item->pendidikan}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->Gaji_akhir), 0, ',', '.')}}</td>
                          <td class="text-center">{{$item->UMR->Rp}}</td>
                          <td class="text-center">{{$item->user->detailpegawai->length_of_service ?? 0}}</td>
                          <td class="text-center">{{$item->Masa_kerja}}</td>
                          <td class="text-center">{{$item->index}}%</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->THP), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->Gaji), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->Ach), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->penyesuaian), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->Bonus ?? '0'), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->Potongan ?? '0'), 0, ',', '.')}}</td>
                          <td class="text-center">
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
                          <td class="text-center">
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
                          <td class="text-center">{{$item->bulan}}</td>
                          <td>
                            <a href="{{route('gaji.edit',$item->id)}}" 
                            onclick="return confirm('Yakin akan edit data ?')" 
                            class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
                            <a href="{{route('gaji.delete',$item->id)}}" 
                            onclick="return confirm('Yakin akan dihapus?')" 
                            class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Hapus</a>
                          </td>                        
                        </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
                <nav>
                    <ul class="pagination justify-content-end">
                        <!-- Tombol Sebelumnya -->
                        @if ($gaji->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"> <i class='fas fa-angle-double-left'></i> Sebelumnya</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $gaji->previousPageUrl() . '&bulan=' . $bulan }}"><i class='fas fa-angle-double-left'></i> Sebelumnya</a>
                        </li>
                        @endif

                        <!-- Tautan Halaman Sebelumnya -->
                        @for ($i = $gaji->currentPage() - 1; $i >= 1; $i--)
                            <li class="page-item">
                                <a class="page-link" href="{{ $gaji->url($i) . '&bulan=' . $bulan }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Tautan Halaman Saat Ini -->
                        <li class="page-item active">
                            <span class="page-link">{{ $gaji->currentPage() }}</span>
                        </li>

                        <!-- Tautan Halaman Selanjutnya -->
                        @for ($i = $gaji->currentPage() + 1; $i <= $gaji->lastPage(); $i++)
                            <li class="page-item">
                                <a class "page-link" href="{{ $gaji->url($i) . '&bulan=' . $bulan }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Tombol Selanjutnya -->
                        @if ($gaji->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $gaji->nextPageUrl() . '&bulan=' . $bulan }}">Selanjutnya <i class='fas fa-angle-double-right'></i></a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link">Selanjutnya <i class='fas fa-angle-double-right'></i></span>
                        </li>
                        @endif
                    </ul>
                </nav>

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