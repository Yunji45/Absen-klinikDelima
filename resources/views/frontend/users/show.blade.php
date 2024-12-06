@extends('layouts.app')

@section('title')
Absensi - Klinik Mitra Delima
@endsection
@section('header')
<style>
            .profile-picture {
            width: 150px; /* Lebar ideal */
            height: 150px; /* Tinggi ideal */
            border-radius: 50%; /* Untuk membuat gambar bulat */
            object-fit: cover; /* Membuat gambar memenuhi kotak tanpa merusak aspek ratio */
        }

</style>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <form action="{{route('cari.presensi.peruser',$user)}}" class="mb-3" method="GET">
                            <div class="form-group row mb- ">
                                <label for="bulan" class="col-form-label col-sm-2">Periode Bulan</label>
                                <div class="input-group col-sm-10">
                                    <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">On-time</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $masuk }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Telat</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $telat }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                            <i class="fas fa-business-time"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Cuti</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $cuti }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                <i class="fas fa-user-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Izin</h5>
                            <span class="h2 font-weight-bold mb-0">{{$izin}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- style="padding: 14px;" -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Tukar Jaga</h5>
                            <span class="h2 font-weight-bold mb-0">{{$tukarjaga}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-gray text-white rounded-circle shadow">
                                <i class="fas fa-people-carry"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Ganti Jaga</h5>
                            <span class="h2 font-weight-bold mb-0">{{$gantijaga}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Lembur</h5>
                            <span class="h2 font-weight-bold mb-0">{{$lembur}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" >
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Hadir</h5>
                            <span class="h2 font-weight-bold mb-0">{{$permohonan}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Detail User</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset(Storage::url($user->foto)) }}" class="card-img mb-3" alt="{{ $user->foto }}">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr><td>NIP</td><td>: {{ $user->nik }}</td></tr>
                                    <tr><td>Nama</td><td>: {{ $user->name }}</td></tr>
                                    <tr><td>Sebagai</td><td>: {{ $user->role }}</td></tr>
                                </tbody>
                            </table>
                            <div class="float-right">
                                <a href="{{ route('users.edit',$user) }}" class="btn btn-sm btn-success" title="Ubah"><i class="fas fa-edit"></i></a>
                                @if ($user->id != auth()->user()->id)
                                    <form class="d-inline-block" action="{{ route('users.destroy',$user) }}" method="post">
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus user ini ???')"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                                <form class="d-inline-block" action="{{ route('users.password',$user) }}" method="post">
                                    @csrf @method('patch')
                                    <button type="submit" class="btn btn-sm btn-dark" onclick="return confirm('Apakah anda yakin ingin mereset password user ini ???')">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold float-left">Kehadiran</h5>
                                <button title="Tambah Kehadiran" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#kehadiran">
                                    <i class="fas fa-plus">ADD</i>
                                </button>
                        <form class="float-right d-inline-block" action="" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-download">EXCEL</i>
                            </button>
                        </form>
                        <form class="float-right d-inline-block" action="{{route('download.peruser',$user)}}" method="get">
                            <input type="hidden" name="bulan" value="{{ request('bulan',date('Y-m')) }}">
                            <button title="Download" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-download">PDF</i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Total Jam</th>
                                        <th>Total Lembur</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$presents->count())
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data yang tersedia</td>
                                        </tr>
                                    @else
                                        @foreach ($presents as $present)
                                            <tr>
                                                <td>{{ date('d/m/Y', strtotime($present->tanggal)) }}</td>
                                                <td>{{ $present->keterangan }}</td>
                                                @if ($present->jam_masuk)
                                                    <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                @if($present->jam_keluar)
                                                    <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                                                    <td>
                                                        <!-- @if (strtotime($present->jam_keluar) <= strtotime($present->jam_masuk))
                                                            {{ 21 - (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) }}
                                                        @else
                                                            @if (strtotime($present->jam_keluar) >= strtotime(config('absensi.jam_pulang') . ' +2 hours'))
                                                                {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 3 }}
                                                            @else
                                                                {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 1 }}
                                                            @endif
                                                        @endif -->
                                                        @php
                                                            $jamMasuk = \Carbon\Carbon::parse($present->jam_masuk);
                                                            $jamKeluar = \Carbon\Carbon::parse($present->jam_keluar);
                                                            $totalJam = $jamMasuk->diffInHours($jamKeluar);
                                                        @endphp
                                                        {{ $totalJam }}

                                                    </td>
                                                    <td>                
                                                    @php
                                                        // Mendapatkan data jadwalterbaru untuk hari ini
                                                        $today = \Carbon\Carbon::now()->format('Y-m-d');
                                                        $user_id = $present->user_id; // Menggunakan user_id dari $present

                                                        $jadwal = \App\Models\jadwalterbaru::where('user_id', $user_id)
                                                            ->where('masa_aktif', '<=', $today)
                                                            ->where('masa_akhir', '>=', $today)
                                                            ->first();

                                                        // Menginisialisasi hasil
                                                        $result = '';
                                                        $totalJamKerja = 0; // Inisialisasi totalJamKerja

                                                        // Periksa apakah ada jadwal untuk hari ini
                                                        if ($jadwal) {
                                                            $namaKolom = 'j' . \Carbon\Carbon::now()->day; // Mendapatkan nama kolom sesuai dengan hari ini
                                                            $jadwalterbaru = $jadwal->$namaKolom;

                                                            if ($jadwalterbaru == 'LL') {
                                                                // Jika jadwal adalah "LL" (Libur Lembur)
                                                                $jamMasuk = \Carbon\Carbon::parse($present->jam_masuk);
                                                                $jamKeluar = \Carbon\Carbon::parse($present->jam_keluar);
                                                                $totalJamKerja = $jamMasuk->diffInHours($jamKeluar);

                                                                if ($totalJamKerja > 9) {
                                                                    $result = ($totalJamKerja - 9) . ' Jam';
                                                                } 
                                                            } else {
                                                                $result = '0 Jam';
                                                            }
                                                        } else {
                                                            // Tidak ada jadwal untuk hari ini
                                                            $result = 'Tidak ada lembur hari ini';
                                                        }
                                                    @endphp

                                                    {{ $result }}

                                                    </td>
                                                @else
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                @endif
                                                <td>
                                                    <button id="btnUbahKehadiran" data-id="{{ $present->id }}" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahKehadiran">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <a href="{{ route('kehadiran.delete', $present->id) }}" type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data presensi ini?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <!-- <div class="float-right">
                                presents->link()
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">Tambah Kehadiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kehadiran.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group row" id="tanggal">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-form-label col-sm-3">Keterangan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">
                                    <option value="Alpha">Alpha</option>
                                    <option value="Masuk">Masuk</option>
                                    <option value="Telat">Telat</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Cuti">Cuti</option>
                                    <option value="Izin">Izin</option>
                                </select>
                                @error('keterangan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="jamMasuk">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Jam Masuk</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_masuk" id="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror">
                                @error('jam_masuk') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="jamKeluar">
                            <label for="jam_keluar" class="col-form-label col-sm-3">Jam Keluar</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_keluar" id="ubah_jam_keluar" class="form-control @error('jam_keluar') is-invalid @enderror">
                                @error('jam_keluar') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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

    <!-- Modal -->
    <div class="modal fade" id="ubahKehadiran" tabindex="-1" role="dialog" aria-labelledby="ubahKehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahKehadiranLabel">Ubah Kehadiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahKehadiran" action="{{ route('ajax.get.kehadiran') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <h5 class="mb-3" id="tanggal"></h5>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group row" id="tanggal">
                            <label for="jam_masuk" class="col-form-label col-sm-3">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ubah_keterangan" class="col-form-label col-sm-3">Keterangan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="ubah_keterangan">
                                    <option value="Alpha" {{ old('keterangan') == 'Alpha' ? 'selected':'' }}>Alpha</option>
                                    <option value="Masuk" {{ old('keterangan') == 'Masuk' ? 'selected':'' }}>Masuk</option>
                                    <option value="Telat" {{ old('keterangan') == 'Telat' ? 'selected':'' }}>Telat</option>
                                    <option value="Sakit" {{ old('keterangan') == 'Sakit' ? 'selected':'' }}>Sakit</option>
                                    <option value="Cuti" {{ old('keterangan') == 'Cuti' ? 'selected':'' }}>Cuti</option>
                                    <option value="Izin" {{ old('keterangan') == 'Cuti' ? 'selected':'' }}>Izin</option>
                                </select>
                                @error('keterangan') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="jamMasuk">
                            <label for="ubah_jam_masuk" class="col-form-label col-sm-3">Jam Masuk</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_masuk" id="ubah_jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror">
                                @error('jam_masuk') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="jamKeluar">
                            <label for="ubah_jam_keluar" class="col-form-label col-sm-3">Jam Keluar</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_keluar" id="ubah_jam_keluar" class="form-control @error('jam_keluar') is-invalid @enderror">
                                @error('jam_keluar') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#jamMasuk').hide();
            $('#keterangan').on('change',function(){
                if ($(this).val() == 'Masuk' || $(this).val() == 'Telat') {
                    $('#jamMasuk').show();
                    $('#jamKeluar').show();
                } else {
                    $('#jamMasuk').hide();
                    $('#jamKeluar').hide();
                }
            });
            $('#btnUbahKehadiran').on('click',function(){
                const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                const id = $(this).data('id');
                $('#formUbahKehadiran').attr('action', "{{ url('kehadiran') }}/" + id);
                $.ajax({
                    url: "{{route('ajax.get.kehadiran')}}",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function (data) {
                        var date = new Date(data.tanggal);
                        var tahun = date.getFullYear();
                        var bulan = date.getMonth();
                        var tanggal = date.getDate();
                        var hari = date.getDay();
                        var jam = date.getHours();
                        var menit = date.getMinutes();
                        var detik = date.getSeconds();
                        switch(hari) {
                            case 0: hari = "Minggu"; break;
                            case 1: hari = "Senin"; break;
                            case 2: hari = "Selasa"; break;
                            case 3: hari = "Rabu"; break;
                            case 4: hari = "Kamis"; break;
                            case 5: hari = "Jum'at"; break;
                            case 6: hari = "Sabtu"; break;
                        }
                        switch(bulan) {
                            case 0: bulan = "Januari"; break;
                            case 1: bulan = "Februari"; break;
                            case 2: bulan = "Maret"; break;
                            case 3: bulan = "April"; break;
                            case 4: bulan = "Mei"; break;
                            case 5: bulan = "Juni"; break;
                            case 6: bulan = "Juli"; break;
                            case 7: bulan = "Agustus"; break;
                            case 8: bulan = "September"; break;
                            case 9: bulan = "Oktober"; break;
                            case 10: bulan = "November"; break;
                            case 11: bulan = "Desember"; break;
                        }
                        $('#tanggal').html(hari +", "+ tanggal +" "+ bulan +" "+ tahun);
                        $('#ubah_keterangan').val(data.keterangan);
                        $('#ubah_jam_masuk').val(data.jam_masuk);
                        $('#ubah_jam_keluar').val(data.jam_keluar);
                    }
                });
            });
        });
    </script>
@endpush
<!-- @push('script')
<script>
    $('.btnUbahKehadiran').on('click', function(){
    const id = $(this).data('id'); // Mengambil ID dari tombol yang diklik
    const tanggal = $(this).data('tanggal'); // Mengambil tanggal dari tombol yang diklik
    const keterangan = $(this).data('keterangan'); // Mengambil keterangan dari tombol yang diklik
    const jamMasuk = $(this).data('jam-masuk'); // Mengambil jam masuk dari tombol yang diklik

    // Mengisi formulir dengan data yang sesuai
    $('#presensi_id').val(id);
    $('#tanggal').html(tanggal);
    $('#ubah_keterangan').val(keterangan);
    $('#ubah_jam_masuk').val(jamMasuk);

    // Tampilkan atau sembunyikan input jam masuk berdasarkan keterangan
    if (keterangan === 'Masuk' || keterangan === 'Telat') {
        $('#jamMasuk').show();
    } else {
        $('#jamMasuk').hide();
    }
});

</script>
@endpush -->
