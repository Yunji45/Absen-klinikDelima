<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifikasi Wajah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
body {
            background-color: #000000; /* Warna hitam */
            color: #ffffff; /* Warna teks putih untuk kontras */
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .btn-capture {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-capture:hover {
            background-color: #0056b3;
        }

        .btn-identify {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-identify:hover {
            background-color: #218838;
        }

        .result-box {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>FACE RECOGNITION</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('biznet.identify') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Ambil dari Kamera:</label>
                            <div class="input-group">
                                <video id="video" class="img-fluid" autoplay></video>
                                <canvas id="canvas" style="display:none"></canvas>
                                <img id="capturedImage" class="img-fluid" style="display:none" alt="Captured Image">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-capture" id="captureButton">Ambil Wajah</button>
                                </div>
                            </div>
                        </div>
                        <textarea id="base64image" name="base64image" style="display:none"></textarea>
                        <button type="submit" class="btn btn-identify btn-block">Identifikasi</button>
                    </form>

                    @if (isset($result))
                        <div class="result-box mt-3">
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
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');

            document.getElementById('base64image').value = imageData;

            capturedImage.src = imageData;
            capturedImage.style.display = 'block';
        });
    });
</script>

</body>
</html>
