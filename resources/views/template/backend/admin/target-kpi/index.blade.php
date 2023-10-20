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
                          <a href="{{route('target.kpi.create')}}" class="btn btn-primary"><i class="fa fa-plus"> Add</i></a>
                        </div>
                      </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                      <tr>
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Nama Target</th>
                          <th scope="col" class="text-center">Periode</th>
                          <th scope="col" class="text-center">Pendaftar</th>
                          <th scope="col" class="text-center">Poli</th>
                          <th scope="col" class="text-center">Farmasi</th>
                          <th scope="col" class="text-center">Kasir</th>
                          <th scope="col" class="text-center">Home Care</th>
                          <th scope="col" class="text-center">Bpjs</th>
                          <th scope="col" class="text-center">Khitan</th>
                          <th scope="col" class="text-center">Rawat Inap</th>
                          <th scope="col" class="text-center">Persalinan</th>
                          <th scope="col" class="text-center">Lab</th>
                          <th scope="col" class="text-center">Umum</th>
                          <th scope="col" class="text-center">Visit Dokter</th>
                          <th scope="col" class="text-center">Action</th>
                        </tr>
                        @php
                        $no =1;
                        @endphp
                        @foreach ($target as $item)
                        <tr>
                          <td class="text-center">{{$no++}}.</td>
                          <td class="text-center">{{$item->name}}</td>
                          <td class="text-center">{{date('m-Y', strtotime($item->start_date))}} s/d {{date('m-Y', strtotime($item->end_date))}}</td>
                          <td class="text-center">{{$item->daftar}}</td>
                          <td class="text-center">{{$item->poli}}</td>
                          <td class="text-center">{{$item->farmasi}}</td>
                          <td class="text-center">{{$item->kasir}}</td>
                          <td class="text-center">{{$item->care}}</td>
                          <td class="text-center">{{$item->bpjs}}</td>
                          <td class="text-center">{{$item->khitan}}</td>
                          <td class="text-center">{{$item->rawat}}</td>
                          <td class="text-center">{{$item->salin}}</td>
                          <td class="text-center">{{$item->lab}}</td>
                          <td class="text-center">{{$item->umum}}</td>
                          <td class="text-center">{{$item->visit}}</td>
                          <td>
                            <a href="{{route('target.kpi.delete',$item->id)}}" 
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
