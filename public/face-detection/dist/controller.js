// //controller.js
// const video = document.getElementById('video');
// const canvas = document.getElementById('canvas');
// const captureButton = document.getElementById('captureButton');
// const profileImage = document.getElementById('profileImage');

// let loggedInUserFaceDescriptor = null;

// // Memuat model-model FaceAPI dan memulai webcam ketika model sudah siap
// Promise.all([
//     faceapi.nets.tinyFaceDetector.loadFromUri('/face-detection/models'),
//     faceapi.nets.faceLandmark68Net.loadFromUri('/face-detection/models'),
//     faceapi.nets.faceRecognitionNet.loadFromUri('/face-detection/models'),
//     faceapi.nets.faceExpressionNet.loadFromUri('/face-detection/models'),
// ]).then(startWebcam).catch(error => console.error(error));

// function startWebcam() {
//     navigator.mediaDevices.getUserMedia({ video: true })
//         .then(stream => {
//             video.srcObject = stream;
//             video.play()
//                 .then(() => {
//                     console.log('Webcam telah diaktifkan.');
//                     initializeFaceRecognition(); // Setelah video dimulai, inisialisasi pengenalan wajah
//                 })
//                 .catch(error => console.error('Gagal memulai video:', error));
//         })
//         .catch(err => console.error('Gagal mendapatkan akses kamera:', err));
// }

// captureButton.addEventListener('click', capturePhoto);

// async function capturePhoto() {
//     // Buat elemen <canvas> untuk menampilkan foto yang diambil
//     const context = canvas.getContext('2d');
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;

//     // Gambar frame video ke canvas
//     context.drawImage(video, 0, 0, canvas.width, canvas.height);

//     // Dapatkan data gambar dalam bentuk URL (base64)
//     const photoDataUrl = canvas.toDataURL('image/jpeg'); // Anda dapat mengganti format sesuai kebutuhan

//     // Mengirim data foto ke server untuk pencocokan
//     const response = await fetch('/compare-face', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ photoDataUrl }),
//     });

//     if (response.ok) {
//         const result = await response.json();

//         if (result.matched) {
//             console.log('Wajah cocok dengan pengguna:', result.username);
//             // Update gambar profil dengan foto yang cocok
//             profileImage.src = result.matchedPhotoUrl;
//         } else {
//             console.log('Wajah tidak cocok dengan pengguna.');
//         }
//     } else {
//         console.error('Gagal mengirim foto untuk pencocokan wajah.');
//     }
// }
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
let labeledFaceDescriptors; // Ini akan menjadi koleksi deskripsi wajah yang sudah dianotasikan dari profil pengguna

// proses pemanggilan model
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/face-detection/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/face-detection/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/face-detection/models'),
  faceapi.nets.faceExpressionNet.loadFromUri('/face-detection/models')
]).then(startWebcam);

async function startWebcam() {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
      video.srcObject = stream;
      setInterval(detectFace, 1000); // Ubah untuk mendeteksi wajah secara berkala
    })
    .catch((err) => console.error(err));
}

async function detectFace() {
  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);

  const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceDescriptors();

  canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

  // Menggambar kotak di sekitar wajah yang terdeteksi
  faceapi.draw.drawDetections(canvas, faceapi.resizeResults(detections, displaySize));

  if (labeledFaceDescriptors) {
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
    detections.forEach((detection) => {
      const bestMatch = faceMatcher.findBestMatch(detection.descriptor);

      // bestMatch sekarang berisi informasi tentang kesamaan dengan profil pengguna
      console.log(bestMatch.toString()); // Ini hanya untuk demonstrasi, Anda bisa melakukan tindakan lain sesuai kebutuhan
    });
  }
}

// Di sini Anda harus memuat deskripsi wajah yang sudah dianotasikan dari profil pengguna
// labeledFaceDescriptors harus berisi array dari wajah-wajah dengan deskripsi
// Setiap deskripsi wajah harus memiliki label yang sesuai dengan profil pengguna
// Anda harus melakukan inisialisasi labeledFaceDescriptors sebelumnya sesuai dengan profil pengguna
// Misalnya:
// labeledFaceDescriptors = [
//   new faceapi.LabeledFaceDescriptors('Profil Pengguna 1', [descriptor1]),
//   new faceapi.LabeledFaceDescriptors('Profil Pengguna 2', [descriptor2]),
//   // ...
// ];

// Mungkin Anda perlu melakukan permintaan AJAX untuk memuat deskripsi dari server atau melalui backend Anda.

