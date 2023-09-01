<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Cuti</title>
</head>
<body>
    <h1>Ajukan Cuti</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('submit.cuti') }}" method="post">
        @csrf

        <label for="tanggal_mulai">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" required>

        <br>

        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" required>

        <br>

        <label for="alasan">Alasan Cuti</label>
        <textarea name="alasan" rows="4" required></textarea>

        <br>

        <button type="submit">Ajukan Cuti</button>
    </form>
</body>
</html>
