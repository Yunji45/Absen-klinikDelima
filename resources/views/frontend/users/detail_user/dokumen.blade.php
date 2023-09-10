
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Dokumen') }}</div>

                <div class="modal-body">
                <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                <form action="{{ route('save.dokumen') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="pdf_files">Sertifikat Diklat (PDF):</label>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <br>
                    <label for="pdf_files">Sertifikat Keahlian (PDF):</label>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                    <small>Maksimal ukuran: 5MB per file.</small>
                    <br>
                    <br>
                    <label for="pdf_files">Lain - Lain (PDF):</label>
                        <br>
                        <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        <small>Maksimal ukuran: 5MB per file.</small>
                        <br>
                        <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        <small>Maksimal ukuran: 5MB per file.</small>
                        <br>
                        <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        <small>Maksimal ukuran: 5MB per file.</small>
                        <br>
                        <input type="file" name="pdf_files[]" id="pdf_files" multiple accept=".pdf">
                        <small>Maksimal ukuran: 5MB per file.</small>
                        <br>
                        <br>


                    <button type="submit" style="background-color: blue; color: white; float: right;">Submit</button>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection