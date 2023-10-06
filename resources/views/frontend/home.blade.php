@extends('layouts.welcome')

@section('title')
    Home - Klinik Mitra Delima
@endsection

@section('content')
    <div class="text-center">
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
                    <button class="btn btn-primary" type="submit" >PRESENSI</button>
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
@endsection
