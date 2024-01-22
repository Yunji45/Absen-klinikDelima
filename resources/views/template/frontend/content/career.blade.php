@extends('template.frontend.layout.main')
@section('content-index')
    <style>
        .job-container {
            margin: 20px 0;
            border: 1px solid #ddd;
            padding: 10px;
            position: relative; /* Tambahkan properti position */
        }

        h2 {
            color: #333;
        }

        p {
            line-height: 1.5;
            color: #666;
        }
        
        .apply-button {
            position: absolute; /* Tambahkan properti position */
            top: 10px; /* Tambahkan properti top */
            right: 10px; /* Tambahkan properti right */
            background-color: #DC143C;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <section class="inner-page">
        <div class="container">
            <p>
                Ini Halaman Apply Pekerjaan
            </p>
            <br>
            <br>
            <div style="text-align: center;">
                <img src="{{ asset('mitradelima/assets/img/hiring.png') }}" alt="" class="img-fluid" style="width: 150px;">
            </div>
            @foreach($job as $item)
            <div class="job-container">
                <h2>Posisi: {{$item->position}}</h2>
                <p>
                    {{$item->deskripsi}}
                </p>
                <p>Kualifikasi:</p>
                <ul>
                    @if($item->kualifikasi_1)
                        <li>{{ $item->kualifikasi_1 }}</li>
                    @endif
                    @if($item->kualifikasi_2)
                        <li>{{ $item->kualifikasi_2 }}</li>
                    @endif
                    @if($item->kualifikasi_3)
                        <li>{{ $item->kualifikasi_3 }}</li>
                    @endif
                    @if($item->kualifikasi_4)
                        <li>{{ $item->kualifikasi_4 }}</li>
                    @endif
                    @if($item->kualifikasi_5)
                        <li>{{ $item->kualifikasi_5 }}</li>
                    @endif
                    @if($item->kualifikasi_6)
                        <li>{{ $item->kualifikasi_6 }}</li>
                    @endif
                    @if($item->kualifikasi_7)
                        <li>{{ $item->kualifikasi_7 }}</li>
                    @endif
                    @if($item->kualifikasi_8)
                        <li>{{ $item->kualifikasi_8 }}</li>
                    @endif
                    @if($item->kualifikasi_9)
                        <li>{{ $item->kualifikasi_9 }}</li>
                    @endif
                    @if($item->kualifikasi_10)
                        <li>{{ $item->kualifikasi_10 }}</li>
                    @endif
                </ul>
                <p>Bagi yang berminat, silakan kirimkan resume dan portofolio Anda dengan cara <a href="">Apply Lowongan Pekerjaan</a>.</p>
                <button class="apply-button">Apply</button>
            </div>
            @endforeach
        </div>
    </section>
@endsection
