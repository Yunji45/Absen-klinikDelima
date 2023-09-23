<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Presensi Klinik Delima Per Hari Ini</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
        <style type="text/css">
            @page {
                size: A4;
                margin: 0;
            }

            body {
                font-size: 12pt;
                line-height: 1.5;
                margin: 0;
                padding: 0;
            }

            table tr td,
            table tr th {
                font-size: 12pt;
                line-height: 1.5;
            }

            .form-group.row {
                display: flex;
                flex-wrap: wrap;
                margin-left: -15px;
                margin-right: -15px;
            }

            .form-group.row > div[class^="col-"] {
                padding-left: 15px;
                padding-right: 15px;
                flex: 0 0 50%;
                /* Atur lebar 50% untuk membuat dua kolom */
            }

            ul {
                list-style-type: none;
                /* Menghilangkan gaya default titik */
                padding: 0;
                /* Menghilangkan padding bawaan dari daftar */
                list-style-position: inside;
                /* Mengatur posisi titik ke dalam (sejajar) */
            }

            li {
                text-align: left;
                /* Mengatur teks agar sejajar ke kiri */
                margin-left: 30px;
                /* Mengatur margin kiri untuk titik */
            }

            .separator {
                border-top: 1px solid #ccc;
                /* Garis pemisah dengan warna abu-abu */
                margin-top: 10px;
                /* Jarak antara judul dan konten */
                margin-bottom: 10px;
                /* Jarak antara konten dan judul berikutnya */
            }
        </style>
    </head>
    <body>
        <center>
            <h5>Data Profil Pegawai</h4>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h6>
        </center>
        <hr class="separator">
        <!-- Garis pemisah -->

        <ul>
            <li>
                <span style="display: inline-block; width: 145px;">NIP</span>
                :
                {{$detail->user->nik}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Nama Lengkap</span>
                :
                {{$detail->name}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Tempat Lahir</span>
                :
                {{$detail->place_birth}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Tanggal Lahir</span>
                :
                {{$detail->date_birth}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Jenis Kelamin</span>
                :
                {{$detail->gender}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Agama</span>
                :
                {{$detail->religion}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Pendidikan</span>
                :
                {{$detail->education}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Program Pendidikan</span>
                :
                {{$detail->program_study}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Alamat</span>
                :
                {{$detail->address}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Jabatan</span>
                :
                {{$detail->position}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Status</span>
                :
                {{$detail->status_pekerjaan}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Tes Psikologi</span>
                :
                {{$detail->tes_psikologi}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">No Telp/Hp</span>
                :
                {{$detail->phone}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Email</span>
                :
                {{$detail->email}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Mulai Bekerja</span>
                :
                {{$detail->hire_date}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Masa Bekerja</span>
                :
                {{$detail->length_of_service}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Status Pernikahan</span>
                :
                {{$detail->marital_status}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Nama Suami/Istri</span>
                :
                {{$detail->spouse_name}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Jumlah Anak</span>
                :
            <li>
                <span style="display: inline-block; width: 145px;">Hobby</span>
                :
                {{$detail->hobbies}}</li>
            <li>
                <span style="display: inline-block; width: 145px;">Keahlian</span>
                :
                {{$detail->skills}}</li>
        </ul>
    </body>
</html>