const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photoButton = document.getElementById('photo-button');
let detectedFaces = [];

// Proses pemanggilan model
Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('/face-detection/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/face-detection/models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('/face-detection/models'),
    faceapi.nets.faceExpressionNet.loadFromUri('/face-detection/models')
]).then(startWebcam);

function startWebcam() {
    navigator.getUserMedia({ video: {} }, (stream) => (video.srcObject = stream), (err) => console.error(err));
}

video.addEventListener('play', renderVideo);

async function renderVideo() {
    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas, displaySize);

    // Memanggil face-api untuk mendeteksi wajah
    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceExpressions();
    const resizedDetections = faceapi.resizeResults(detections, displaySize);
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

    // Menambahkan hasil deteksi wajah ke dalam objek detectedFaces
    detectedFaces.push(resizedDetections);

    // Menampilkan kotak, landmark, dan ekspresi wajah pada video
    faceapi.draw.drawDetections(canvas, resizedDetections);
    faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
    faceapi.draw.drawFaceExpressions(canvas, resizedDetections);

    setTimeout(() => renderVideo(), 100); // Mendeteksi setiap 0.1 detik
}

// Mengambil foto wajah
// Mendapatkan hasil deteksi terbaru saat tombol di klik
photoButton.addEventListener('click', () => {
  if (detectedFaces.length > 0) {
      const canvasToSave = document.createElement('canvas');
      const context = canvasToSave.getContext('2d');
      const face = detectedFaces[detectedFaces.length - 1]; // Mengambil hasil deteksi terbaru

      // Menyesuaikan ukuran canvas dengan wajah yang terdeteksi
      canvasToSave.width = face.detection.box.width;
      canvasToSave.height = face.detection.box.height;

      // Menggambar wajah yang terdeteksi ke canvas baru
      context.drawImage(video, face.detection.box.x, face.detection.box.y, face.detection.box.width, face.detection.box.height, 0, 0, face.detection.box.width, face.detection.box.height);

      // Simpan gambar ke file
      const dataURL = canvasToSave.toDataURL('image/png');
      const a = document.createElement('a');
      a.href = dataURL;
      a.download = 'face_photo.png';
      a.click();
  }
});
