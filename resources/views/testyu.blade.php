<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import library face-api.js -->
    <script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
    <script defer src="{{asset('face-detection/dist/face-api.min.js')}}"></script>
    <script defer src="{{asset('face-detection/dist/controller.js')}}"></script>
</head>
<body>
    <!-- Menampilkan video dari webcam -->
    <div class="container">
        <h1>Face Detection</h1>
        <video id="video" width="640" height="480" autoplay muted></video>
        <canvas id="canvas"></canvas>
        <button id="photo-button">Take Photo</button>
    </div>
</body>
</html>
