@extends('layouts.welcome')

@section('title')
    Home - Klinik Mitra Delima
@endsection

@section('content')
    <div class="text-center">
        @if ($present)
            @if ($present->keterangan == 'Alpha')
                @if (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PS') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PS')))
                    <p>Silahkan Check-in</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-primary" type="submit">Check-in</button>
                    </form>
                @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_SM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_SM')))
                    <p>Silahkan Check-in</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-primary" type="submit">Check-in</button>
                    </form>
                @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PM')))
                    <p>Silahkan Check-in</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-primary" type="submit">Check-in</button>
                    </form>
                @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar')))
                    <p>Silahkan Check-in</p>
                    <form action="{{ route('kehadiran.check-in') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-primary" type="submit">Check-in</button>
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
                        <p>Jika pekerjaan telah selesai silahkan check-out</p>
                        <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                            @csrf @method('patch')
                            <button class="btn btn-primary" type="submit">Check-out</button>
                        </form>
                    @else
                        <p>Check-out Belum Tersedia</p>
                    @endif
                @endif
            @endif
        @else
            @if (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PS') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PS')))
                <p>Silahkan Check-in</p>
                <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit" >Absen</button>
                </form>
            @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_SM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_SM')))
                <p>Silahkan Check-in</p>
                <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">Absen</button>
                </form>
            @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PM')))
                <p>Silahkan Check-in</p>
                <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">Absen</button>
                </form>
            @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar')))
                <p>Silahkan Check-in</p>
                <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button class="btn btn-primary" type="submit">Absen</button>
                </form>
            @else
                <p>Check-in Belum Tersedia</p>
            @endif
        @endif
    </div>
@endsection
