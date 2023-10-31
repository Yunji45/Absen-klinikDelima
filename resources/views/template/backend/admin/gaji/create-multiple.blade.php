@extends('template.layout.app.main') 
@section('tabel')
<section class="section">
    <div class="section-header">
        <h1>{{$title}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="#">{{$title}}</a>
            </div>
            <div class="breadcrumb-item">{{$title}}
                Forms</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{$title}}
            Forms</h2>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('multiple.gaji.save')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="bulan" class="col-form-label col-sm-3">Gaji Bulan</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control @error('bulan') is-invalid @enderror"
                                        name="bulan"
                                        id="bulan">
                                        <option value="">Pilih</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    @error('bulan')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_id" class="col-form-label col-sm-3">Nama</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 @error('user_id') is-invalid @enderror"
                                        multiple="multiple"
                                        name="user_id[]"
                                        id="user_id">
                                        @foreach ($data as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="form-group row" id="Potongan">
                                <label for="Potongan" class="col-form-label col-sm-3">Potongan</label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        name="Potongan"
                                        id="Potongan"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="isi dengan 0 jika tidak ada potongan"
                                        required="required">
                                    @error('Potongan')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="Bonus">
                                <label for="Bonus" class="col-form-label col-sm-3">Tambahan</label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        name="Bonus"
                                        id="Bonus"
                                        class="form-control @error('Bonus') is-invalid @enderror"
                                        placeholder="isi dengan 0 jika tidak ada tambahan"
                                        required="required">
                                    @error('Bonus')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> -->
                            <div class="modal-footer">
                                <a href="" type="button" class="btn btn-secondary">Batal</a>
                                <!-- <button type="submit" class="btn btn-success">Simpan</button> -->
                                <input type="submit" class="btn btn-success" value="Simpan Data">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>

<script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();

        $("#addForm").on('submit', function (e) {
            e.preventDefault();
            $("#saveBtn")
                .html('Processing...')
                .attr('disabled', 'disabled');
            var link = $(this).attr('action');
            var selectedUsers = $('#user_id').val();
            // var selectedBulan = $('#bulan').val();

            // Dapatkan token CSRF dari tag meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: link,
                type: "POST",
                data: {
                    user_id: selectedUsers,
                    // bulan: selectedBulan
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    $("#saveBtn")
                        .html('SIMPAN')
                        .removeAttr('disabled');
                    if (response.status) {
                        $('#user_id')
                            .val(null)
                            .trigger("change");
                        // $('#bulan')
                        //     .val(null)
                        //     .trigger("change");
                        alert(response.message);
                    }
                },
                error: function (response) {
                    $("#saveBtn")
                        .html('SIMPAN')
                        .removeAttr('disabled');
                    alert(response.message);
                }
            });
        });
    });
</script>

@endsection