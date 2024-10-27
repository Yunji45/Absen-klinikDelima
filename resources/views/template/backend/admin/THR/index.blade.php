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
                <div class="breadcrumb-item" style="font-size:16px; font-weight:bold;">Total THR : {{'Rp.' . number_format(floatval($total), 0, ',', '.')}}</a></div>
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
                        <input type="month" class="form-control" name="tahun" id="tahun" placeholder="Search Tahun" value="{{ request('tahun', date('Y')) }}">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                        </div>
                    </form>
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search By Name">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                        </div>
                   </div>
                   
                </div>
                <div class="card-body px-4">
                <div class="d-flex justify-content-end mb-4">
                    <button type="button" class="btn btn-outline-primary mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('thr.add') }}">Add Normal</a>
                        <form id="get-data-form" action="{{ route('thr.multiple') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('get-data-form').submit();">Get Data Multiple</a>
                    </div>              
                    <a href="{{route('thr.pdf',['tahun' => request('tahun', date('Y'))])}}" class="btn btn-outline-danger mr-2">
                        <i class="fa fa-download">
                            </i> PDF
                    </a>
                    <a href="{{ route('thr.excel', ['tahun' => request()->input('tahun', date('Y'))]) }}" class="btn btn-outline-success mr-2">
                        <i class="fa fa-download"></i> Excel
                    </a>
                    <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#import">
                      <i class="fa fa-download">
                          </i> Import Excel
                    </a>
      
                </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-md" id="myTable">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pendidikan</th>
                            <th>Gaji Terakhir</th>
                            <th>THR</th>
                            <th>Masa Kerja</th>
                            <th>Presentase</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($data as $item)
                        <tr>
                          <td class="text-center">{{$no++}}.</td>
                          <td class="text-center">{{$item->user->name}}</td>
                          <td class="text-center">{{$item->pendidikan}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->gaji_terakhir), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->THR), 0, ',', '.')}}</td>
                          <td class="text-center">{{$item->masa_kerja}}</td>
                          <td class="text-center">{{$item->index}}%</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($item->bulan)->year }}</td>                          
                          <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('thr.edit', $item->id) }}" 
                                   onclick="return confirm('Yakin akan edit data ?')" 
                                   class="btn btn-outline-success btn-sm">
                                   <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <form action="{{ route('thr.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin akan dihapus?')" 
                                            class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form> 
                            </div>
                        </td>
                                               
                        </tr>
                        @endforeach
                        <tr class="table-success">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center">TOTAL</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($total), 0, ',', '.')}}</td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>                          
                          <td></td>                        
                        </tr>
                        <tr class="table-success">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center">Query Data</td>
                          <td class="text-center">{{$user}}</td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>                          
                          <td></td>                        
                        </tr>
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
        <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">IMPORT DATA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('thr.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>PILIH FILE</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                            <button type="submit" class="btn btn-success">IMPORT</button>
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