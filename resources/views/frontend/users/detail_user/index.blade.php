@extends('layouts.app')
@section('title')
    Profil - {{ config('app.name') }}
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold">{{$title}}</h5>
                </div>
                <div class="card-body">
                    <div class="text-right mb-3">
                        @if (!$existingDetail)
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#kehadiran">Lengkapi Profil</a>
                        @endif
                    </div>
                        <div class="text-center mb-3">
                            <img id="image" src="{{ asset('/storage/public/'. Auth::user()->foto) }}" alt="{{ Auth::user()->foto }}" class="img-thumbnail mb-1">
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2 text-left">NIK Pegawai</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ Auth::user()->nik }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Nama Lengkap</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->name : 'Belum Lengkap' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Tempat, Tanggal Lahir</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->place_birth . ', ' . $detail->first()->date_birth : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Gender</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->gender : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Religion</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->religion : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Education</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->education : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Jurusan</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->program_study : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Alamat</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->address : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Jabatan</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->position : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">No.Telp</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->phone : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Email</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->email : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Mulai Bekerja</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->hire_date : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Masa Bekerja</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->length_of_service : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Akhir Bekerja</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->exit_date : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Alasan</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->exit_reason : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Status</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->marital_status : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Suami/Istri</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->spouse_name : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Jumlah Anak</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->number_of_children : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Hobbies</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->hobbies : 'Belum Ada' }}</p>
                            </div>
                            <div class="col-sm-2 text-left">Keahlian</div>
                            <div class="col-sm-10">
                                <p class="form-control-static">: {{ $detail->isNotEmpty() ? $detail->first()->skills : 'Belum Ada' }}</p>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="kehadiranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kehadiranLabel">Form Lengkapi Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('update-profil.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h5 class="mb-3">{{ date('l, d F Y') }}</h5>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="form-group row" id="name">
                            <label for="name" class="col-form-label col-sm-3">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input name="name" rows="4" class="form-control @error('name') is-invalid @enderror" ></input>
                                @error('name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="place_birth">
                            <label for="alasan" class="col-form-label col-sm-3">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input name="place_birth" rows="4" class="form-control @error('place_birth') is-invalid @enderror" required></input>
                                @error('place_birth') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="date_birth">
                            <label for="date_birth" class="col-form-label col-sm-3">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" name="date_birth" id="date_birth" class="form-control @error('date_birth') is-invalid @enderror">
                                @error('date_birth') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-form-label col-sm-3">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                    <option value="Laki-Laki" >Laki-Laki</option>
                                    <option value="Perempuan" >Perempuan</option>
                              </select>
                                @error('gender') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="religion" class="col-form-label col-sm-3">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('religion') is-invalid @enderror" name="religion" id="religion">
                                    <option value="Islam" >Islam</option>
                                    <option value="Kristen" >Kristen</option>
                                    <option value="Buddha" >Budha</option>
                                    <option value="Konghucu" >Konghucu</option>
                                    <option value="Hindu" >Hindu</option>
                                </select>
                                @error('religion') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="education" class="col-form-label col-sm-3">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('education') is-invalid @enderror" name="education" id="education">
                                    <option value="SMK/SMA" >SMA/SMK</option>
                                    <option value="D3/S1" >D3/S1</option>
                                    <option value="S2" >S2</option>
                                    <option value="S3" >S3</option>
                              </select>
                                @error('education') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="program_study">
                            <label for="program_study" class="col-form-label col-sm-3">Jurusan</label>
                            <div class="col-sm-9">
                                <input name="program_study" rows="4" class="form-control @error('program_study') is-invalid @enderror" required></input>
                                @error('program_study') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="address">
                            <label for="address" class="col-form-label col-sm-3">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="address" rows="4" class="form-control @error('address') is-invalid @enderror" required></textarea>
                                @error('address') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="position">
                            <label for="position" class="col-form-label col-sm-3">Jabatan</label>
                            <div class="col-sm-9">
                                <input name="position" rows="4" class="form-control @error('position') is-invalid @enderror" required></input>
                                @error('position') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="phone">
                            <label for="phone" class="col-form-label col-sm-3">No.Telepon/HP</label>
                            <div class="col-sm-9">
                                <input name="phone" rows="4" class="form-control @error('phone') is-invalid @enderror" required></input>
                                @error('phone') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="email">
                            <label for="email" class="col-form-label col-sm-3">Email Aktif</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" rows="4" class="form-control @error('email') is-invalid @enderror" required></input>
                                @error('email') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="hire_date">
                            <label for="hire_date" class="col-form-label col-sm-3">Mulai Bekerja</label>
                            <div class="col-sm-9">
                                <input type="date" name="hire_date" id="hire_date" class="form-control @error('hire_date') is-invalid @enderror">
                                @error('tanggal_mulai') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="length_of_service">
                            <label for="length_of_service" class="col-form-label col-sm-3">Lama Bekerja</label>
                            <div class="col-sm-9">
                                <input name="length_of_service" rows="4" class="form-control @error('length_of_service') is-invalid @enderror" required></input>
                                @error('length_of_service') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="exit_date">
                            <label for="exit_date" class="col-form-label col-sm-3">Berakhir Bekerja</label>
                            <div class="col-sm-9">
                                <input type="date" name="exit_date" id="exit_date" class="form-control @error('exit_date') is-invalid @enderror">
                                @error('exit_date') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="exit_reason">
                            <label for="exit_reason" class="col-form-label col-sm-3">Alasan</label>
                            <div class="col-sm-9">
                                <input name="exit_reason" rows="4" class="form-control @error('exit_reason') is-invalid @enderror" required></input>
                                @error('exit_reason') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="marital_status" class="col-form-label col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" id="marital_status">
                                    <option value="Lajang" >Lajang</option>
                                    <option value="Menikah" >Menikah</option>
                              </select>
                                @error('gender') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="spouse_name">
                            <label for="spouse_name" class="col-form-label col-sm-3">Suami/Istri</label>
                            <div class="col-sm-9">
                                <input name="spouse_name" rows="4" class="form-control @error('spouse_name') is-invalid @enderror" required></input>
                                @error('spouse_name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="number_of_children">
                            <label for="number_of_children" class="col-form-label col-sm-3">Jumlah Anak</label>
                            <div class="col-sm-9">
                                <input name="number_of_children" rows="4" class="form-control @error('number_of_children') is-invalid @enderror" required></input>
                                @error('number_of_children') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="hobbies">
                            <label for="hobbies" class="col-form-label col-sm-3">Hoby</label>
                            <div class="col-sm-9">
                                <input name="hobbies" rows="4" class="form-control @error('hobbies') is-invalid @enderror" required></input>
                                @error('hobbies') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="skills">
                            <label for="skills" class="col-form-label col-sm-3">Keahlian</label>
                            <div class="col-sm-9">
                                <input name="skills" rows="4" class="form-control @error('skills') is-invalid @enderror" required></input>
                                @error('skills') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
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
