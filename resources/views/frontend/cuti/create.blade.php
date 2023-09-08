<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Cuti</title>
</head>
<body>
    <h1>Ajukan Izin</h1>

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

    <form action="{{ route('pengajuan.cuti') }}" method="post">
    @csrf

    <label for="jenis_izin">Jenis Izin</label>
    <select name="jenis_izin" required>
        <option value="sakit">Sakit</option>
        <option value="izin">Izin</option>
        <option value="cuti_tahunan">Cuti Tahunan</option>
        <option value="cuti_bersama">Cuti Bersama</option>
        <option value="cuti_besar">Cuti Besar</option>
        <option value="cuti_melahirkan">Cuti Melahirkan</option>
        <!-- Anda bisa menambahkan jenis izin lainnya jika diperlukan -->
    </select>
    <br>

    <label for="tanggal_mulai">Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" required>
    <br>
    <label for="tanggal_berakhir">Tanggal Selesai</label>
    <input type="date" name="tanggal_berakhir" required>
    <br>
    <label for="alasan">Alasan Izin</label>
    <textarea name="alasan" rows="4" required></textarea>
    <br>
    <button type="submit">Ajukan Izin</button>
</form>
</body>
</html>
