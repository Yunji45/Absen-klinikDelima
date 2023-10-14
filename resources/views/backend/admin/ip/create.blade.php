<form method="POST" action="{{ route('update.ip') }}">
    @csrf

    <label for="ip">Alamat IP Baru:</label>
    <input type="text" name="ip" id="ip" value="{{ $currentIP }}">
    <button type="submit">Ubah IP</button>
</form>
