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
  /* .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .signature-box {
            width: 45%;
            text-align: center;
        }
        .signature-box p {
            border-top: 1px solid #000;
            margin-top: 50px;
        } */
        .signature-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 50px;

    }
    .signature-box {
        text-align: center;
        margin-bottom: 10px;
    }
    .signature-box img {
        display: block;
        margin: 0 auto;
    }
    .signature-line {
        border-top: 1px solid #000;
        width: 100px;
        margin: 5px auto;
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
      <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-body">
                      <br>
                        <ol>
                        <h3 class="text-center">Attendance Board</h3>

                            <li>
                                <p> <strong>Persiapkan Diri:</strong> Pastikan Anda berada di zona tempat yang sesuai untuk melakukan absensi.</p>
                            </li>
                            <li>
                                <p><strong>Login ke Sistem:</strong> Buka aplikasi atau situs web absensi dan masukkan kredensial login Anda.</p>
                            </li>
                            <li>
                                <p><strong>Pilih Menu Absensi:</strong> Setelah login, pilih menu absensi yang tersedia di dashboard Anda (components->presensi).</p>
                            </li>
                            <li>
                                <p> <strong>Lakukan kredensial presensi:</strong> klik Button OR Face Recognition atau lainnya sesuai instruksi by System.</p>
                            </li>
                            <li>
                              <p><strong>Error:</strong> Jika terjadi problem maka konfirmasi kendala yang dihadapi kepada pihak terkait atau bisa gunakan Live Chat.</p>
                            </li>
                            <li>
                                <p><strong>Cek Status Absensi:</strong> Cek kembali status absensi Anda untuk memastikan bahwa absensi telah tercatat dengan benar.</p>
                            </li>
                            <li>
                                <p><strong>Logout:</strong> Setelah selesai, jangan lupa untuk logout dari sistem untuk menjaga keamanan akun Anda.</p>
                            </li>
                            <li>
                              <p><strong>========== Have a nice day. ==========</strong></p>
                            </li>
                        </ol>
                        <div class="signature-container">
                            <div class="signature-box">
                                @if ($spv)
                                    <div>{{ $spv->name }}</div>
                                    <div><img src="{{ asset('storage/signatures/' . $spv->signature) }}" alt="Signature" width="100"></div>
                                    <div class="signature-line"></div>
                                @else
                                    <div colspan="2">not found</div>
                                @endif
                                <p>cc: Hrd/Spv</p>
                            </div>
                            <div class="signature-box">
                                @if ($dir)
                                    <div>{{ $dir->name }}</div>
                                    <div><img src="{{ asset('storage/signatures/' . $dir->signature) }}" alt="Signature" width="100"></div>
                                    <div class="signature-line"></div>
                                @else
                                    <div colspan="2">not found</div>
                                @endif
                                <p>cc: CEO/Direktur</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>

    </section>
@endsection