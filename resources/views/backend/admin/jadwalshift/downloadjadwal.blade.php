<!DOCTYPE html>
<html>
    <head>
        <title>Jadwal Shift Klinik Mitra Delima</title>
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

    @media print {
        table {
            width: 100%; /* Membuat tabel memanjang sepanjang halaman saat dicetak */
        }
    }
</style>
<style>
    .table-container {
    width: 100%;
    overflow-x: auto; /* Membuat tabel responsif jika terlalu lebar */
    margin: 0 auto; /* Pusatkan tabel secara horizontal */
}

table {
    width: 100%; /* Lebar tabel mengisi wadah */
    border-collapse: collapse;
}

th, td {
    padding: 2px; /* Atur padding sel header dan sel data */
}

th {
    background-color: yellow;
}

tr:nth-child(even) {
    background-color: #f2f2f2; /* Atur latar belakang baris ganjil */
}

/* Tambahkan gaya lain yang Anda inginkan di sini */

</style>

        <center>
            <h5>Jadwal Shift klinik Mitra Delima</h4>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h5>
        </center>

        <div class="table-container">
                        <table border="1" style="text-align: center;">
                            <tr>
                                <th rowspan="2" bgcolor="yellow">NO</th>
                                <th rowspan="2" bgcolor="yellow">Nama Pegawai</th>
                                <th colspan="31" bgcolor="#00ff80" style="text-align: center;">Jadwal Shift</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= 31; $i++)
                                <th>{{ $i }}</th>
                                @endfor

                            </tr>
                            @php $no =1; @endphp @if($data->isEmpty())
                            <tr>
                                <td colspan="34" style="text-align: center; font-size: 14px;">Tidak ada data yang tersedia</td>
                            </tr>
                            @else @foreach ($data as $item)
                            <tr>
                                <td style="text-align: center; font-size: 14px;">{{$no++}}.</td>
                                <td style="text-align: center; font-size: 9px;">{{$item->user->name}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j1}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j2}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j3}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j4}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j5}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j6}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j7}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j8}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j9}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j10}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j11}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j12}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j13}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j14}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j15}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j16}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j17}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j18}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j19}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j20}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j21}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j22}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j23}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j24}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j25}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j26}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j27}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j28}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j29}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j30}}</td>
                                <td style="text-align: center; font-size: 14px;">{{$item->j31}}</td>
                            </tr>
                            @endforeach @endif

                        </table>                        
                        </div>


    </body>
</html>