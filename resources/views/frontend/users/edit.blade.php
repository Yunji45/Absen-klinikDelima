@extends('layouts.app')
@section('title')
Ubah User - Klinik Mitra Delima
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
                    <h5 class="m-0 pt-1 font-weight-bold float-left">Ubah User</h5>
                    <a href="{{ route('users.show',$user) }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action=" {{ route('users.update', $user->id) }} " method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="text-center mb-3">
                            <img src="{{ asset(Storage::url($user->foto)) }}" class="profile-picture" alt="{{ $user->foto }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="foto" class="float-right col-form-label">Foto</label></div>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="foto">Ubah Foto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="nik" class="float-right col-form-label">NIK</label></div>
                            <div class="col-sm-10">
                                <input type="text" onkeypress="return hanyaAngka(event)" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $user->nik }}">
                                @error('nik') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="name" class="float-right col-form-label">Nama</label></div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="saldo_cuti" class="float-right col-form-label">Saldo Cuti</label></div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('saldo_cuti') is-invalid @enderror" id="saldo_cuti" name="saldo_cuti" value="{{ $user->saldo_cuti }}">
                                @error('saldo_cuti') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="role" class="float-right col-form-label ">Sebagai</label></div>
                            <div class="col-sm-10">
                                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                                    <option value="">Pilih</option>
                                    <option value="admin" {{ old('role',$user->role_id) == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="pegawai" {{ old('role',$user->role_id) == 2 ? 'selected' : '' }}>Pegawai</option>
                                </select>
                                @error('role') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">
                                    Simpan
                                </button>
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
