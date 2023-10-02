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
            <h5>Data Index Profil Pegawai</h4>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h5>
        </center>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>TTL</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
            @php $no =1; @endphp @foreach ($detail as $item)
                                <tr>
                                    <td>{{$no++}}.</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->place_birth}},{{$item->date_birth}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->religion}}</td>
                                    <td>{{$item->position}}</td>
                                </tr>
                                @endforeach
            </tbody>
        </table>

    </body>
</html>