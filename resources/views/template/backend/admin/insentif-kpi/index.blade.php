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
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{$title}} Table</h4>
                      <div class="card-header-form">
                        <div class="buttons">
                          <!-- <a href="{{route('gaji.umr.create')}}" class="btn btn-primary"><i class="fa fa-plus"> Add</i></a> -->
                          <button title="Tambah Kehadiran" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#kehadiran">
                                    <i class="fas fa-plus">Add</i>
                          </button>
                        </div>
                      </div>
                  </div>
                  <div class="card-body p-0">
                  <div class="table-responsive">
                      <table class="table table-bordered table-dark">
                      <caption>Data Pendapatan Klinik</caption>
                      <tr>
                          <th scope="col" class="text-center">Omset Bulan Ini :</th>
                          <th scope="col" class="text-center">Skor Klinik Bulan Ini :</th>
                        </tr>
                        <tr>
                            <td scope="col" class="text-center bg-warning">{{'Rp.' . number_format(floatval($poin->omset), 0, ',', '.')}}</td>
                            <td scope="col" class="text-center bg-warning">{{$poin->skor}}</td>
                        </tr>
                        <tr>
                          <th scope="col" class="text-center">Total Uang Yang Dibagikan :</th>
                          <th scope="col" class="text-center">Index Rupiah Bulan ini :</th>
                        </tr>
                        <tr>
                            <td scope="col" class="text-center bg-warning">{{'Rp.' . number_format(floatval($poin->total_insentif), 0, ',', '.')}}</td>
                            <td scope="col" class="text-center bg-warning">{{'Rp.' . number_format(floatval($poin->index_rupiah), 0, ',', '.')}}</td>
                        </tr>
                      </table>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped">
                      <caption>Data Insentif Pegawai</caption>
                      <tr>
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Nama</th>
                          <th scope="col" class="text-center">Poin</th>
                          <th scope="col" class="text-center">Insentif Yang Di Terima</th>
                          <th scope="col" class="text-center">Date</th>
                          <th scope="col" class="text-center">Action</th>
                        </tr>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($insentif as $item)
                        <tr>
                          <td class="text-center">{{$no++}}.</td>
                          <td class="text-center">{{$item->user->name}}</td>
                          <td class="text-center">{{$item->poin_user}}</td>
                          <td class="text-center">{{'Rp.' . number_format(floatval($item->insentif_final), 0, ',', '.')}}</td>
                          <td class="text-center">{{$item->bulan}}</td>
                          <td>
                            <a href="{{route('insentif.kpi.delete',$item->id)}}" 
                            onclick="return confirm('Yakin akan dihapus?')" 
                            class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
                <form action="{{ route('insentif.kpi.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="user_id" id="user_id">
                                    <option value="">Pilih</option>
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('bulan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Bulan</label>
                            <div class="col-sm-9">
                                <input type="date" name="bulan" id="bulan" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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