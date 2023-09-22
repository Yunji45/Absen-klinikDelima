<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Presensi Klinik Delima Per Hari Ini</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
    </head>
    <body>
        <style type="text/css">
            table tr td,
            table tr th {
                font-size: 9pt;
            }
        </style>
        <center>
            <h5>Laporan Presensi Klinik Mitra Delima</h4>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h5>
        </center>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Total Jam</th>
                </tr>
            </thead>
            <tbody>
                @if (!$presents->count())
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data yang tersedia</td>
                </tr>
                @else @foreach ($presents as $present)
                <tr>
                    <td>{{$present->user->name}}</td>
                    <td>{{ date('d/m/Y', strtotime($present->tanggal)) }}</td>
                    <td>{{ $present->keterangan }}</td>
                    @if ($present->jam_masuk)
                    <td>{{ date('H:i:s', strtotime($present->jam_masuk)) }}</td>
                    @else
                    <td>-</td>
                    @endif @if($present->jam_keluar)
                    <td>{{ date('H:i:s', strtotime($present->jam_keluar)) }}</td>
                    <td>
                        @if (strtotime($present->jam_keluar) <= strtotime($present->jam_masuk))
                        {{ 21 - (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) }}
                        @else @if (strtotime($present->jam_keluar) >=
                        strtotime(config('absensi.jam_pulang') . ' +2 hours'))
                        {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 3 }}
                        @else
                        {{ (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse($present->jam_keluar))) - 1 }}
                        @endif @endif
                    </td>
                    @else
                    <td>-</td>
                    <td>-</td>
                    @endif
                </tr>
                @endforeach @endif
            </tbody>
        </table>

    </body>
</html>