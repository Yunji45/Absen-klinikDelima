<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<div class="container">
    <form action="{{ route('coba.save') }}" method="POST" id="addForm">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="user_id">Pilih User (Multiple):</label>
            <select id="user_id" name="user_id[]" class="form-control select2" multiple="multiple">
                @foreach($user as $users)
                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="target_id">Pilih Target:</label>
            <select id="target_id" name="target_id" class="form-control select2">
                @foreach($ach as $target)
                    <option value="{{ $target->id }}">{{ $target->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tambahkan elemen formulir lainnya sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
<script>
$(document).ready(function() {
    $('.select2').select2();

    $("#addForm").on('submit', function(e) {
        e.preventDefault();
        $("#saveBtn").html('Processing...').attr('disabled', 'disabled');
        var link = $(this).attr('action');
        var selectedUsers = $('#user_id').val();
        var selectedTarget = $('#target_id').val();

        // Dapatkan token CSRF dari tag meta
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: link,
            type: "POST",
            data: {
                user_id: selectedUsers,
                target_id: selectedTarget,
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $("#saveBtn").html('SIMPAN').removeAttr('disabled');
                if (response.status) {
                    $('#user_id').val(null).trigger("change");
                    $('#target_id').val(null).trigger("change");
                    alert(response.message);
                }
            },
            error: function(response) {
                $("#saveBtn").html('SIMPAN').removeAttr('disabled');
                alert(response.message);
            }
        });
    });
});


</script>
