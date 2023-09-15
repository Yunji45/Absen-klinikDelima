const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
// proses pemanggilan model
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
    // digunakan untuk inisialisasi 
    const displaySize = { width: video.width, height: video.height }
    faceapi.matchDimensions(canvas, displaySize)
// memanggil face-api sebagai inisialisasi pengenalan wajah
    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceExpressions()
    const resizedDetections = faceapi.resizeResults(detections, displaySize)
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

    //menambkan kan kotak pada muka sebagai tanda pendeteksian wajah berhasil
    faceapi.draw.drawDetections(canvas, resizedDetections)
    // digunakan untuk menampilkan faceLandmark
    faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
    //digunakan untuk menampilkan expresi wajah
    faceapi.draw.drawFaceExpressions(canvas, resizedDetections)

    setTimeout(() => renderVideo(),3000)
}
