<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Presensi Klinik Delima Per Hari Ini</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha364-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ764/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
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
            .no-wrap {
        white-space: nowrap;
    }
        </style>
    </head>
    <body>
        <center>
            <h5>Data Profil Pegawai</h5>
            <h6>
                <a target="_blank" href="https://klinikmitradelima.com/">www.klinimitrakdelima.com</a>
            </h6>
        </center>
        <hr class="separator">
        <!-- Garis pemisah -->
        <!-- <div class="text-center mb-3">
            <img
                id="image"
                src="{{asset(Storage::url($detail->user->foto)) }}"
                alt="{{ $detail->user->foto }}"
                class="profile-picture"
                >
        </div> -->

        <ul>
            <li>
                <span style="display: inline-block; width: 145px;">NIP</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->user->nik}}</span>:
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Nama Lengkap</span>
                <span class="no-wrap" style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->name))}}</span>
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Tempat Lahir</span>
                <span style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->place_birth))}}</span>
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Tanggal Lahir</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->date_birth}}</span>
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Jenis Kelamin</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->gender}}</span>
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Agama</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->religion}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Pendidikan</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->education}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Program Pendidikan</span>
                <span class="no-wrap" style="display: inline-block; width: 145px;">: {{ ucfirst(strtolower($detail->program_study)) }}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Alamat</span>
                <span class="no-wrap" style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->address))}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Jabatan</span>
                <span style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->position))}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Status</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->status_pekerjaan}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Tes Psikologi</span>
                <span style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->tes_psikologi))}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">No Telp/Hp</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->phone}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Email</span>
                <span class="no-wrap" style="display: inline-block; width: 145px;">: {{$detail->email}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Mulai Bekerja</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->hire_date}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Masa Bekerja</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->length_of_service}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Status Pernikahan</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->marital_status}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Nama Suami/Istri</span>
                <span style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->spouse_name))}}</span>
                
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Jumlah Anak</span>
                <span style="display: inline-block; width: 145px;">: {{$detail->number_of_children}}</span>
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Hobby</span>
                <span style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->hobbies))}}</span>
                </li>
            <li>
                <span style="display: inline-block; width: 145px;">Keahlian</span>
                <span style="display: inline-block; width: 145px;">: {{ucfirst(strtolower($detail->skills))}}</span>
                
                </li>
            <li>
            @if (isset($detail->user->jumlahanak) && $detail->user->jumlahanak->isNotEmpty())
                                <div class="text-center">
                                    <table style="border-collapse: collapse; width: 80%;">
                                        <thead>
                                            <tr>
                                                <th style="border: 1px solid #000; padding: 6px;">Nama Anak</th>
                                                <th style="border: 1px solid #000; padding: 6px;">Umur Anak</th>
                                                <th style="border: 1px solid #000; padding: 6px;">Tanggal Lahir Anak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail->user->jumlahanak as $anak)
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 6px;">{{ $anak->nama_anak }}</td>
                                                <td style="border: 1px solid #000; padding: 6px;">{{ $anak->umur }} Tahun</td>
                                                <td style="border: 1px solid #000; padding: 6px;">{{ $anak->tanggal_lahir }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
            </li>
        </ul>
    </body>
</html>