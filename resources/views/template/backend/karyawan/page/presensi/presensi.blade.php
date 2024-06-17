@extends('template.backend.karyawan.layouts.app')
@section('content')
<style>
  .card-custom {
    background-color: white;
    border: 2px solid green;
    margin: 20px;
    padding: 20px;
  }
  .card-custom .btn-primary {
    background-color: green;
    border-color: green;
  }
  .card-custom .btn-primary:hover {
    background-color: darkgreen;
    border-color: darkgreen;
  }
</style>

<div class="pagetitle">
      <h1>{{$title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.html">Components</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card card-custom">
            <div class="card-body text-center">
              @if ($present)
                @if ($present->keterangan == 'Alpha')
                  @if (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PS') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PS')))
                    <p>Silahkan Absen</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                      <button class="btn btn-primary" type="submit">PRESENSI</button>
                    </form>
                  @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_SM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_SM')))
                    <p>Silahkan Absen</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                      <button class="btn btn-primary" type="submit">PRESENSI</button>
                    </form>
                  @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PM')))
                    <p>Silahkan Absen</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                      <button class="btn btn-primary" type="submit">PRESENSI</button>
                    </form>
                  @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar')))
                    <p>Silahkan Absen</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                      <button class="btn btn-primary" type="submit">PRESENSI</button>
                    </form>
                  @else
                    <p>Check-in Belum Tersedia</p>
                  @endif
                @elseif ($present->keterangan == 'Cuti')
                  <p>Anda Sedang Cuti</p>
                @else
                  <p>Check-in hari ini pukul: ({{ $present->jam_masuk }})</p>
                  @if ($present->jam_keluar)
                    <p>Check-out hari ini pukul: ({{ $present->jam_keluar }})</p>
                  @else
                    @if (strtotime('now') >= strtotime(config('absensi.jam_keluar_PS')) || strtotime('now') >= strtotime(config('absensi.jam_keluar_SM')) || strtotime('now') >= strtotime(config('absensi.jam_keluar_PM')))
                      <p>Jika pekerjaan telah selesai silahkan absen keluar</p>
                      <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                        @csrf @method('patch')
                        <button class="btn btn-primary" type="submit">KELUAR</button>
                      </form>
                    @else
                      <p>Check-out Belum Tersedia</p>
                    @endif
                  @endif
                @endif
              @else
                @if (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PS') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PS')))
                  <p>Silahkan Absen</p>
                  <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">PRESENSI</button>
                  </form>
                @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_SM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_SM')))
                  <p>Silahkan Absen</p>
                  <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">PRESENSI</button>
                  </form>
                @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PM')))
                  <p>Silahkan Absen</p>
                  <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">PRESENSI</button>
                  </form>
                @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar')))
                  <p>Silahkan Absen</p>
                  <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">PRESENSI</button>
                  </form>
                @else
                  <p>Absen Belum Tersedia</p>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection