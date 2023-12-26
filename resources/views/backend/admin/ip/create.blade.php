<form action="{{ route('update-ip') }}" method="POST">
    @csrf
    @method('POST')
    <label for="ip">Alamat IP Baru:</label>
    <input type="text" name="ip" id="ip" value="{{ config('absensi.ip_internet') }}">
    <button type="submit">Simpan</button>
</form>
