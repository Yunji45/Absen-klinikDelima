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
            <div class="job-container">
                <h2>Posisi: Web Developer</h2>
                <p>
                    Kami sedang mencari seorang Web Developer yang berpengalaman untuk bergabung dengan tim kami.
                    Jika Anda memiliki keterampilan dalam pengembangan web dan minat dalam proyek-proyek menarik,
                    kami ingin mendengar dari Anda!
                </p>
                <p>Kualifikasi:</p>
                <ul>
                    <li>Pengalaman dalam pengembangan web menggunakan HTML, CSS, dan JavaScript.</li>
                    <li>Kemampuan untuk bekerja dalam tim.</li>
                    <li>Kreatif dan memiliki kemampuan problem-solving.</li>
                </ul>
                <p>Bagi yang berminat, silakan kirimkan resume dan portofolio Anda dengan cara <a href="">Apply Lowongan Pekerjaan</a>.</p>
                <button class="apply-button">Apply</button>
            </div>

            <div class="job-container">
                <h2>Posisi: Administrasi</h2>
                <p>
                    Kami sedang mencari seorang Administrasi yang berpengalaman untuk bergabung dengan tim kami.
                    Jika Anda memiliki keterampilan dalam administrasi dan minat dalam bekerja di lingkungan kesehatan,
                    kami ingin mendengar dari Anda!
                </p>
                <p>Kualifikasi:</p>
                <ul>
                    <li>Pengalaman dalam pekerjaan administratif.</li>
                    <li>Kemampuan untuk bekerja dalam tim.</li>
                    <li>Rapi, teliti, dan memiliki kemampuan organisasi yang baik.</li>
                </ul>
                <p>Bagi yang berminat, silakan kirimkan resume dan portofolio Anda dengan cara <a href="">Apply Lowongan Pekerjaan</a>.</p>
                <button class="apply-button">Apply</button>
            </div>

            <div class="job-container">
                <h2>Posisi: Bidan</h2>
                <p>
                    Kami sedang mencari seorang Bidan yang berpengalaman untuk bergabung dengan tim kami.
                    Jika Anda memiliki keterampilan dalam pelayanan kesehatan maternal dan pediatrik,
                    serta minat dalam memberikan perawatan yang berkualitas, kami ingin mendengar dari Anda!
                </p>
                <p>Kualifikasi:</p>
                <ul>
                    <li>Pendidikan formal sebagai Bidan dengan sertifikat yang valid.</li>
                    <li>Pengalaman kerja dalam pelayanan kesehatan maternal dan pediatrik.</li>
                    <li>Kemampuan berkomunikasi dan bekerja dengan pasien dan tim medis.</li>
                </ul>
                <p>Bagi yang berminat, silakan kirimkan resume dan portofolio Anda dengan cara <a href="">Apply Lowongan Pekerjaan</a>.</p>
                <button class="apply-button">Apply</button>
            </div>
        </div>
    </section>
@endsection
