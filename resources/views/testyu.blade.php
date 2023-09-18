<!DOCTYPE html>
<html>
<head>
    <title>Face Detection</title>
</head>
<body>
    <h1>Face Detection</h1>
    
    <video id="video" width="640" height="480" autoplay></video>
    <canvas id="canvas" width="640" height="480"></canvas>

    <script src="{{ asset('js/opencv.js') }}"></script>
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');

        // Setup video streaming
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function (err) {
                console.error('Error accessing the camera:', err);
            });

        // Load OpenCV.js
        cv.onRuntimeInitialized = function () {
            startFaceDetection();
        };

        function startFaceDetection() {
            const cap = new cv.VideoCapture(video);
            const classifier = new cv.CascadeClassifier();

            // Load the pre-trained face detection model
            classifier.load('haarcascade_frontalface_default.xml');

            const FPS = 30;
            function processVideo() {
                try {
                    if (!streaming) {
                        // clean and stop.
                        cap.delete();
                        return;
                    }
                    let src = new cv.Mat(video.height, video.width, cv.CV_8UC4);
                    cap.read(src);

                    // Do the face detection
                    let gray = new cv.Mat();
                    cv.cvtColor(src, gray, cv.COLOR_RGBA2GRAY);
                    let faces = new cv.RectVector();
                    classifier.detectMultiScale(gray, faces, 1.1, 3, 0);

                    // Draw rectangles around detected faces
                    for (let i = 0; i < faces.size(); i++) {
                        let face = faces.get(i);
                        let point1 = new cv.Point(face.x, face.y);
                        let point2 = new cv.Point(face.x + face.width, face.y + face.height);
                        cv.rectangle(src, point1, point2, [255, 0, 0, 255]);
                    }

                    // Display the result on the canvas
                    cv.imshow(canvas, src);
                    src.delete();
                    gray.delete();

                    setTimeout(processVideo, 1000 / FPS);
                } catch (err) {
                    console.error(err);
                }
            }

            // Start processing the video stream
            processVideo();
        }
    </script>
</body>
</html>
