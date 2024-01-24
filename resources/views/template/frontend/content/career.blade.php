@extends('template.frontend.layout.main')
@section('content-index')
<style>
    /* Gaya untuk input pencarian */
    .logo-container {
        text-align: center;
        margin-bottom: 20px; /* Menambahkan margin di bagian bawah container */
    }
    .logo {
        width: 150px;
        height: auto;
    }

    .input-group {
        text-align: center;
        margin-top: 20px; /* Menambahkan margin di bagian atas container */
    }

    #myInput {
        padding: 10px;
        width: 50%; /* Mengurangi lebar input */
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    

    .btn-primary {
        background-color: #28a745;
        color: #fff;
        border: 1px solid #007bff;
        border-radius: 4px;
        padding: 10px;
        cursor: pointer;
    }

    /* Gaya untuk hasil pencarian */
    .job-container {
        margin: 20px 0;
        border: 1px solid #ddd;
        padding: 10px;
        position: relative;
        transition: transform 0.3s ease-in-out;
    }

    .job-container:hover {
        transform: scale(1.03); /* Efek scaling ketika dihover */
    }

    h2 {
        color: #333;
        margin-bottom: 10px;
    }

    p {
        line-height: 1.5;
        color: #666;
        margin-bottom: 10px;
    }

    ul {
        margin-bottom: 10px;
    }

    li {
        color: #888;
    }

    .apply-button {
        position: absolute;
        top: 10px;
        right: 10px;
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
                <img src="{{ asset('mitradelima/assets/img/hiring.png') }}" alt="" class="img-fluid" style="width: 150px; height: auto;">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search Berdasarkan Posisi Yang Ingin Di Apply ....">
                <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
            @foreach($job as $item)
            <div class="job-container" id="myTable">
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
                <p>Bagi yang berminat, silakan kirimkan resume dan portofolio Anda dengan cara <a href="{{route('job-app.pelamar')}}">Apply Lowongan Pekerjaan</a>.</p>
                <a href="{{route('job-app.pelamar')}}" class="apply-button">Apply</a>
            </div>
            @endforeach
        </div>
    </section>
    <script>
        function myFunction() {
            var input, filter, jobContainers, h2, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            jobContainers = document.querySelectorAll(".job-container");

            jobContainers.forEach(function (jobContainer) {
                h2 = jobContainer.querySelector("h2");
                txtValue = h2.textContent || h2.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    jobContainer.style.display = "";
                } else {
                    jobContainer.style.display = "none";
                }
            });
        }
    </script>
@endsection
