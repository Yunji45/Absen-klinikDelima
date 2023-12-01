<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import library face-api.js -->
</head>
<body>
    <!-- Menampilkan video dari webcam -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Identifikasi Wajah</div>

                    <div class="card-body">
                        <!-- Form untuk mengambil gambar dari kamera -->
<!-- Form untuk mengambil gambar dari kamera -->
<form action="{{ route('biznet.identify') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Ambil dari Kamera:</label>
        <div class="input-group">
            <video id="video" width="320" height="240" autoplay></video>
            <canvas id="canvas" style="display:none"></canvas>
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary" id="captureButton">Ambil Foto</button>
            </div>
        </div>
    </div>
    <!-- Menambahkan textarea untuk menyimpan data gambar dalam format base64 -->
    <textarea id="base64image" name="base64image" style="display:none"></textarea>
    <button type="submit" class="btn btn-primary">Identifikasi</button>
</form>


                        <!-- Hasil identifikasi -->
                        @if (isset($result))
                            <div class="mt-3">
                                <h5>Hasil Identifikasi:</h5>
                                <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk mengambil gambar dari kamera -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('captureButton');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.error('Error accessing camera: ', error);
                });

            captureButton.addEventListener('click', function () {
                // Ambil gambar dari video dan konversi ke base64
                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = canvas.toDataURL('image/png');

                // Set nilai textarea dengan data gambar dalam format base64
                document.getElementById('base64image').value = imageData;
            });
        });
    </script>
</body>
</html>

