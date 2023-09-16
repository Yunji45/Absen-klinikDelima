<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tambahan -->
    <script defer src="{{ asset('face-detection/dist/face-api.min.js') }}"></script>
    <script defer src="{{ asset('face-detection/dist/controller.js') }}"></script>
</head>
<body>
    <!-- Video dan Tombol -->
    <video id="video" width="640" height="480" autoplay muted></video>
    <canvas id="canvas" width="640" height="480"></canvas>
    <button id="captureButton">Ambil Foto</button>

    <!-- Gambar Profil Pengguna -->
    <img id="profileImage" src="{{ asset(Storage::url(Auth::user()->foto)) }}" alt="{{ Auth::user()->foto }}" class="profile-picture">

    <!-- JavaScript -->
</body>
</html>
