@extends('layouts.welcome')
@section('title')
    Home - Klinik Mitra Delima
@endsection
@section('content')

    @if ($libur)
        <div class="text-center">
            <p>Absen Libur (Hari Libur Nasional {{ $holiday }})</p>
        </div>
    @else
        @if ($libur)
            <div class="text-center">
                <p>Absen Libur</p>
            </div>
        @else
            @if ($present)
                @if ($present->keterangan == 'Alpha')
                    <div class="text-center">
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
                    </div>
                @elseif ($present->keterangan == 'Cuti')
                    <div class="text-center">
                        <p>Anda Sedang Cuti</p>
                    </div>
                @else
                    <div class="text-center">
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
                    </div>
                @endif
            @else
                <div class="text-center">
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
                </div>
            @endif
        @endif
    @endif
@endsection
