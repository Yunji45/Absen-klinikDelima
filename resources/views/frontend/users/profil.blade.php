@extends('layouts.app')
@section('title')
    Profil - {{ config('app.name') }}
@endsection
@section('content')
<style>
            .profile-picture {
            width: 150px; /* Lebar ideal */
            height: 150px; /* Tinggi ideal */
            border-radius: 50%; /* Untuk membuat gambar bulat */
            object-fit: cover; /* Membuat gambar memenuhi kotak tanpa merusak aspek ratio */
        }

</style>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold">Profil</h5>
                </div>
                <div class="card-body">
                    <form action=" {{ route('update-profil', Auth::user()->id) }} " method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="text-center mb-3">
                        @if (Auth::user()->foto == 'default.jpeg')
                            <img id="image" src="{{ asset('/storage/default.jpeg') }}" alt="" class="profile-picture">
                        @else
                            <img id="image" src="{{ asset(Storage::url(Auth::user()->foto)) }}" alt="{{ Auth::user()->foto }}" class="profile-picture">
                        @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="foto" class="col-form-label">Foto</label></div>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" >
                                    <label class="custom-file-label" for="foto">Ubah Foto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="nik" class="col-form-label">NIK</label></div>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="nik" class="col-form-label">Cuti</label></div>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" id="saldo_cuti" name="saldo_cuti" value="{{ Auth::user()->saldo_cuti }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="name" class="col-form-label">Nama</label></div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}">
                                @error('nama') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">
                                    Simpan
                                </button>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a href="{{route('detail.user.index',Auth::user()->id)}}" class="btn btn-info btn-block">
                                    Detail
                                </a>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a href="{{route('upload.dokumen')}}" class="btn btn-dark btn-block">
                                    Upload Sertifikat Pendukung
                                </a>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a href="{{route('upload.sertifikat')}}" class="btn btn-warning btn-block">
                                    Upload Dokumen Pendukung
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('document').ready(function(){
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endpush
