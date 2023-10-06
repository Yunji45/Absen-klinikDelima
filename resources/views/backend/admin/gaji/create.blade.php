<!DOCTYPE html>
<html>
<head>
    <title>Form Gaji</title>
</head>
<body>
    <h2>Form Gaji</h2>
    <form action="{{ route('gaji.save') }}" method="POST">
        @csrf
        @method('POST')
        <label for="user_id">User ID:</label>
        <div class="col-sm-9">
            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                @foreach ($data as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <label for="bulan">Bulan:</label>
            <select name="bulan" id="bulan">
                <option value="01">Januari</option>
                <option value="02">Februari</option>
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

        <label for="pendidikan">Pendidikan:</label>
        <input type="text" id="pendidikan" name="pendidikan" required><br><br>

        <label for="standar_UMR">Standar UMR:</label>
        <div class="col-sm-9">
            <select class="form-control @error('user_id') is-invalid @enderror" name="umr_id" id="umr_id">
                @foreach ($umr as $gaji)
                <option value="{{ $gaji->id }}">{{ $gaji->name }}/{{$gaji->Rp}}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
        
        <label for="index">Index:</label>
        <input type="teks" id="index" name="index" required><br><br>
        
        <label for="Masa_kerja">Masa Kerja:</label>
        <input type="teks" id="Masa_kerja" name="Masa_kerja" required><br><br>

        <input type="submit" value="Hitung Gaji">
    </form>
</body>
</html>
