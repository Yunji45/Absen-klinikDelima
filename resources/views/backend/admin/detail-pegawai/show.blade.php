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
        <div class="col-md-12">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold">{{$title}}</h5>
                </div>
                <div class="card-body">
                        <div class="text-center mb-3">
                            <img id="image" src="{{ asset(Storage::url($detail->user->foto)) }}" alt="{{ $detail->user->foto }}" class="profile-picture" >
                        </div>

                        <div class="text-center mb-3">
                            <h5>{{ $detail->name }}</h5>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-left">NIK</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->user->nik }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Nama Lengkap</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->name }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Tempat, Tanggal Lahir</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->place_birth }}, {{$detail->date_birth}}</p>
                            </div>
                            <div class="col-sm-2 text-left">Gender</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->gender}}</p>
                            </div>
                            <div class="col-sm-2 text-left">Religion</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->religion }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Education</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->education }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Jurusan</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->program_study}}</p>
                            </div>
                            <div class="col-sm-2 text-left">Alamat</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->address}}</p>
                            </div>
                            <div class="col-sm-2 text-left">Jabatan</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->position}}</p>
                            </div>
                            <div class="col-sm-2 text-left">No.Telp</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->phone }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Email</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->email }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Mulai Bekerja</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->hire_date }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Masa Bekerja</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->length_of_service }} Tahun</p>
                            </div>
                            <div class="col-sm-2 text-left">Akhir Bekerja</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->exit_date }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Alasan</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->exit_reason }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Status</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->marital_status }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Suami/Istri</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->spouse_name  }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Jumlah Anak</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->number_of_children  }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Hobbies</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->hobbies  }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Keahlian</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->skills  }}</p>
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            <h5>FILE PENDUKUNG</h5>
                        </div>

                        <div class="form-group row">
                        @php
                            $userId = Auth::id();
                        @endphp

                        <div class="col-sm-2 text-left">Dokumen : </div>
                            <div class="col-sm-10">
                                <ul>
                                    @foreach ($detail->user->dokumen as $dokumen)
                                        <li>
                                            <a href="{{ asset('storage/dok_pegawai/' . $detail->user->name . '/' . $dokumen->filename) }}" target="_blank">
                                                {{ $dokumen->filename }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="col-sm-2 text-left">Sertifikat : </div>
                            <div class="col-sm-10">
                            <ul>
                                    @foreach ($detail->user->sertifikat as $dokumen)
                                        <li>
                                            <a href="{{ asset('storage/sertifikat_pegawai/' . $detail->user->name . '/' . $dokumen->filename) }}" target="_blank">
                                                {{ $dokumen->filename }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        </div>
                    </div>

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
