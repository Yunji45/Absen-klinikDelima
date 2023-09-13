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
        <center>
            <h5>Jadwal Shift klinik Mitra Delima</h4>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h5>
        </center>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                    <th>19</th>
                    <th>20</th>
                    <th>21</th>
                    <th>22</th>
                    <th>23</th>
                    <th>24</th>
                    <th>25</th>
                    <th>26</th>
                    <th>27</th>
                    <th>28</th>
                    <th>29</th>
                    <th>30</th>
                    <th>31</th>
                </tr>
            </thead>
            <tbody>
                @php $no =1; @endphp @foreach ($data as $item)
                <tr>
                    <td>{{$no++}}.</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->j1}}</td>
                    <td>{{$item->j2}}</td>
                    <td>{{$item->j3}}</td>
                    <td>{{$item->j4}}</td>
                    <td>{{$item->j5}}</td>
                    <td>{{$item->j6}}</td>
                    <td>{{$item->j7}}</td>
                    <td>{{$item->j8}}</td>
                    <td>{{$item->j9}}</td>
                    <td>{{$item->j10}}</td>
                    <td>{{$item->j11}}</td>
                    <td>{{$item->j12}}</td>
                    <td>{{$item->j13}}</td>
                    <td>{{$item->j14}}</td>
                    <td>{{$item->j15}}</td>
                    <td>{{$item->j16}}</td>
                    <td>{{$item->j17}}</td>
                    <td>{{$item->j18}}</td>
                    <td>{{$item->j19}}</td>
                    <td>{{$item->j20}}</td>
                    <td>{{$item->j21}}</td>
                    <td>{{$item->j22}}</td>
                    <td>{{$item->j23}}</td>
                    <td>{{$item->j24}}</td>
                    <td>{{$item->j25}}</td>
                    <td>{{$item->j26}}</td>
                    <td>{{$item->j27}}</td>
                    <td>{{$item->j28}}</td>
                    <td>{{$item->j29}}</td>
                    <td>{{$item->j30}}</td>
                    <td>{{$item->j31}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </body>
</html>