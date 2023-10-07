@extends('layouts.app')

@section('title')
    Gaji - Klinik Mitra Delima
@endsection
@section('content')
<div class="container">
        <div class="row">

            <div class="col-md-12 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">{{$title}}</h5>

                        <form class="float-right d-inline-block" action="" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </button>
                            <button title="Tambah Kehadiran" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#kehadiran">
                                    <i class="fas fa-plus">ADD</i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>UMR</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no =1; @endphp @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item ->name}}</td>
                                    <td>{{$item->Rp}}</td>
                                    <td>
                                        <a href="{{route('gaji.UMR.delete',$item->id)}}" class="btn btn-sm btn-danger" title="{{$title}}"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen pengguna ini?')">
                                        <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('gaji.UMR.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <div class="form-group row" id="name">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="UMK">
                            <label for="UMK" class="col-form-label col-sm-3">UMR</label>
                            <div class="col-sm-9">
                                <input type="text" name="UMK" id="UMK" class="form-control @error('name') is-invalid @enderror">
                                @error('UMK') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
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
