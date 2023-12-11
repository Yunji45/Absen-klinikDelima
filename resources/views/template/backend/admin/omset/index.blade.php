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
          <div class="section-header">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#kehadiran">
                <i class="fa fa-plus">
                    Add</i>
            </a>
            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#kehadiran">
                <i class="fa fa-download">
                    PDF</i>
            </a>
        </div>


          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                        <h4>{{$title}} Table</h4>
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
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                      <tr>
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Omset Bulan Ini</th>
                          <th scope="col" class="text-center">Total Skor</th>
                          <th scope="col" class="text-center">Total Insentif</th>
                          <th scope="col" class="text-center">Index Rupiah</th>
                          <th scope="col" class="text-center">Date</th>
                          <th scope="col" class="text-center">Action</th>
                        </tr>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($omset as $item)
                        <tr>
                          <td class="text-center">{{$no++}}.</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->omset), 0, ',', '.')}}</td>
                          <td class="text-center">{{$item->skor}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->total_insentif), 0, ',', '.')}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->index_rupiah), 0, ',', '.')}}</td>
                          <td class="text-center">{{$item->bulan}}</td>
                          <td class="text-center">
                            <a href="{{route('setup.insentif.delete',$item->id)}}" 
                            onclick="return confirm('Yakin akan dihapus?')" 
                            class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>

                            <a href="{{route('edit.omset',$item->id)}}" 
                            class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

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
                <form action="{{ route('setup.insentif.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-9">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Total Skor Bulan Ini</label>
                            <div class="col-sm-9">
                                <input type="number" name="skor" id="skor" class="form-control @error('skor') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div> -->
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Omset Klinik</label>
                            <div class="col-sm-9">
                                <input type="number" name="omset" id="omset" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Omset Perbulan">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">Index</label>
                            <div class="col-sm-9">
                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="index" id="index">
                                    <option value="">Pilih</option>
                                    <option value="10.0">10.0</option>
                                    <option value="9.0">9.0</option>
                                    <option value="8.0">8.0</option>
                                    <option value="7.0">7.0</option>
                                    <option value="6.0">6.0</option>
                                    <option value="5.0">5.0</option>
                                    <option value="4.0">4.0</option>
                                    <option value="0">Batas 3.0</option>
                                    <option value="3.9">3.9</option>
                                    <option value="3.8">3.8</option>
                                    <option value="3.7">3.7</option>
                                    <option value="3.6">3.6</option>
                                    <option value="3.5">3.5</option>
                                    <option value="3.4">3.4</option>
                                    <option value="3.3">3.3</option>
                                    <option value="3.2">3.2</option>
                                    <option value="3.1">3.1</option>
                                    <option value="3.0">3.0</option>
                                    <option value="0">Batas 2.0</option>
                                    <option value="2.0">2.0</option>
                                    <option value="1.9">1.9</option>
                                    <option value="1.8">1.8</option>
                                    <option value="1.7">1.7</option>
                                    <option value="1.6">1.6</option>
                                    <option value="1.5">1.5</option>
                                    <option value="1.4">1.4</option>
                                    <option value="1.3">1.3</option>
                                    <option value="1.2">1.2</option>
                                    <option value="1.1">1.1</option>
                                </select>
                                <!-- <input type="number" name="index" id="index" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Bilangan Desimal Untuk Persen">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror -->
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
            <script>
        $(document).ready(function () {
            $("#closeModalBtn").click(function () {
            $("#kehadiran").modal("hide"); // "kehadiran" adalah ID modal Anda
        });

            // Ketika input UMK berubah
            $("#UMKInput").on("input", function () {
                // Ambil nilai dari input UMK
                var inputValue = $(this).val();

                // Hapus semua karakter selain angka
                var numericValue = inputValue.replace(/\D/g, '');

                // Format angka ke format Rupiah
                var formattedValue = formatRupiah(numericValue);

                // Set kembali nilai input dengan format Rupiah
                $(this).val(formattedValue);
            });

            // Ketika form disubmit
            $("form").submit(function (event) {
                // Ambil nilai dari input UMK
                var inputValue = $("#UMKInput").val();

                // Hapus semua karakter selain angka
                var numericValue = inputValue.replace(/\D/g, '');

                // Set kembali nilai input dengan format angka yang valid
                $("#UMKInput").val(numericValue);
                return true; // Lanjutkan proses submit form
            });

            // Fungsi untuk memformat angka ke format Rupiah
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var hasil = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + hasil;
            }
        });
    </script>

@endsection
