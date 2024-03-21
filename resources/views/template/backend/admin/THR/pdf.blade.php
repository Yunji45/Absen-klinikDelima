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
            <h5>Data THR Karyawan MD</h4>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h5>
        </center>

        <table class='table table-bordered'>
            <thead>
                <tr>
                        <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Nama</th>
                          <th scope="col" class="text-center">THR</th>
                          <th scope="col" class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; $totalGaji = 0; @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}.</td>
                        <td class="text-center">{{$item->user->name}}</td>
                        <td class="text-center">{{'Rp.' . number_format(floatval($item->THR), 0, ',', '.')}}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->bulan)->year }}</td>                          
                    </tr>
                    @php $totalGaji += floatval($item->THR); @endphp
                @endforeach

                <!-- Tampilkan total gaji di baris terakhir -->
                <tr>
                    <td colspan="2" class="text-right"><strong>Total Gaji:</strong></td>
                    <td class="text-center"><strong>{{ 'Rp.' . number_format($totalGaji, 0, ',', '.') }}</strong></td>
                    <td></td>
                </tr>
            </tbody>

        </table>

    </body>
</html>