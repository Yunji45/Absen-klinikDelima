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

    /* Gaya untuk formulir */
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin: 0 auto; /* Agar formulir berada di tengah */
    }

    h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    input, textarea, button, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

    button {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 12px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

</style>

<section class="inner-page">
    <div class="container">
        <p>Apply Pekerjaan</p>
        <br>
        <br>
        <div class="logo-container">
            <img src="{{ asset('mitradelima/assets/img/hiring.png') }}" alt="" class="img-fluid" style="width: 150px; height: auto;">
        </div>
        <form action="{{route('job-app.save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Job Application Form</h3>
            <label for="vacancy_id">Posisi Yang Di Lamar:</label>
            <select id="vacancy_id" name="vacancy_id" required>
                <option value="">Pilih Posisi</option>
                @foreach($job as $item)
                <option value="{{$item->id}}">{{$item->position}}</option>
                @endforeach
            </select>
            <label for="nama_lengkap">Masukan Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            <label for="email">Masukan Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="cover_letter">Masukan Cover Letter:</label>
            <textarea id="cover_letter" name="cover_letter" rows="4"></textarea>
            <label for="foto">Upload Foto Diri:</label>
            <input type="file" id="foto" name="foto">
            <label for="file_cv">Upload CV (Curriculum Vitae):</label>
            <input type="file" id="file_cv" name="file_cv" required>
            <label for="file_pendukung">Upload Supporting Document:</label>
            <input type="file" id="file_pendukung" name="file_pendukung">
            <button type="submit">Submit Application</button>
        </form>
    </div>
</section>
@endsection
