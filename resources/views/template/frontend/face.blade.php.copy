<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifikasi Wajah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white text-center">
                    Mau Kemana ?? Buru-buru amat bro !!<br>
                    Ayoo Identifikasi Wajah Dulu Ya !!
                </div>
                <div class="card-body">
                    <form action="{{ route('biznet.identify') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Ambil dari Kamera:</label>
                            <div class="input-group">
                                <video id="video" class="img-fluid" autoplay></video>
                                <canvas id="canvas" style="display:none"></canvas>
                                <!-- Menambahkan elemen untuk menampilkan gambar yang diambil -->
                                <img id="capturedImage" class="img-fluid" style="display:none" alt="Captured Image">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="captureButton">Ambil Foto</button>
                                </div>
                            </div>
                        </div>
                        <textarea id="base64image" name="base64image" style="display:none"></textarea>
                        <button type="submit" class="btn btn-primary ml-auto">Identifikasi</button>
                    </form>

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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const capturedImage = document.getElementById('capturedImage');
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

            // Tampilkan gambar yang diambil
            capturedImage.src = imageData;
            capturedImage.style.display = 'block';
        });
    });
</script>

</body>
</html>
