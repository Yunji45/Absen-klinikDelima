@extends('template.layout.app.main') @section('tabel')
<section class="section">
    <div class="section-header">
        <h1>Profil User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">Profil User</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>ON-TIME</h4>
                  </div>
                  <div class="card-body">
                  {{ $masuk }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-business-time"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TELAT</h4>
                  </div>
                  <div class="card-body">
                  {{ $telat }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user-clock"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>CUTI</h4>
                  </div>
                  <div class="card-body">
                  {{ $cuti }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>IZIN</h4>
                  </div>
                  <div class="card-body">
                  {{ $izin }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-people-carry"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TUKAR JAGA</h4>
                  </div>
                  <div class="card-body">
                  {{ $tukarjaga }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user-shield"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>GANTI JAGA</h4>
                  </div>
                  <div class="card-body">
                  {{ $gantijaga }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-user-md"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>LEMBUR</h4>
                  </div>
                  <div class="card-body">
                    0
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-thumbtack"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TOTAL HADIR</h4>
                  </div>
                  <div class="card-body">
                    0
                  </div>
                </div>
              </div>
            </div>
            <div class="section-header">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#kehadiran">
                    <i class="fa fa-plus">
                        </i> ADD
                </a>
                <a href="" class="btn btn-danger">
                    <i class="fa fa-download">
                        </i> PDF
                </a>
                <a href="" class="btn btn-success">
                    <i class="fa fa-download">
                        </i> EXCEL
                </a>
                <div class="section-header-breadcrumb">
                                <form action="{{route('cari.presensi.peruser',$user)}}" method="get">
                                    @csrf
                                    <div class="input-group">
                                    <input type="month" class="form-control" name="bulan" id="bulan" value="{{ request('bulan',date('Y-m')) }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                    </div>
                                </form>

                </div>
                
        </div>
    </div>
    <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">                     
                    <img alt="image" src="{{ asset(Storage::url($user->foto)) }}" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">NIP</div>
                        <div class="profile-widget-item-value">{{ $user->nik }}</div>
                      </div>
                    </div>
                  </div>
                    <div class="profile-widget-description">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>: {{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role</strong></td>
                                    <td>: {{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: {{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No Telp</strong></td>
                                    <td>: {{ $user->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cuti</strong></td>
                                    <td>: {{ $user->saldo_cuti }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                  <div class="card-footer text-center">
                    <div class="mt-2">
                        <a href="#" class="btn btn-success mr-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" class="btn btn-danger mr-1">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-key"></i> Reset Password
                        </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Rekap Absensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Masuk</th>
                                        <th>Total Jam</th>
                                        <th>Total Lembur</th>
                                        <th>Aksi</th>
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
                                                @endif
                                                <td>
                                                    <!-- <button id="btnUbahKehadiran" data-id="{{ $present->id }}" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahKehadiran">
                                                        <i class="far fa-edit"></i>
                                                    </button> -->
                                                    <a href="{{ route('kehadiran.delete', $present->id) }}" type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data presensi ini?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
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