<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class FaceController extends Controller
{
    public function compareFace(Request $request)
    {
        $photoDataUrl = $request->input('photoDataUrl');

        // Simpan data foto dalam file sementara
        $tempFilename = 'absen_face.jpg';
        $tempFilePath = storage_path('app/temp/' . $tempFilename);
        File::put($tempFilePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photoDataUrl)));

        // Mendapatkan deskriptor wajah dari foto yang diambil
        $capturedFaceDescriptor = $this->getFaceDescriptor($tempFilePath);
        $loggedInUserFaceDescriptor = $this->getLoggedInUserFaceDescriptor();

        if ($loggedInUserFaceDescriptor) {
            // Lakukan pencocokan wajah
            $faceMatcher = new \FaceAPI\FaceMatcher([$loggedInUserFaceDescriptor]);
            $bestMatch = $faceMatcher->findBestMatch([$capturedFaceDescriptor]);

            if ($bestMatch['_label'] !== 'unknown') {
                // Pencocokan berhasil, kirim respons positif
                return response()->json([
                    'matched' => true,
                    'username' => Auth::user()->username, // Anda dapat mengganti ini dengan informasi pengguna yang sesuai
                    'matchedPhotoUrl' => asset(Storage::url(Auth::user()->foto)),
                ]);
            }
        }
        // Jika tidak ada pencocokan, kirim respons negatif
        return response()->json(['matched' => false], Response::HTTP_UNAUTHORIZED);
    }

    private function getFaceDescriptor($photoFilePath)
    {
        // Implementasi untuk mendapatkan deskriptor wajah dari foto yang diambil
        // Anda dapat menggunakan pustaka seperti OpenCV atau FaceAPI.js di sini
        // Pastikan mengembalikan deskriptor dalam format yang sesuai
    }

    private function getLoggedInUserFaceDescriptor()
    {
        // Implementasi untuk mendapatkan deskriptor wajah pengguna yang sedang login
        // Dari database atau sumber data lainnya
        // Pastikan mengembalikan deskriptor dalam format yang sesuai
    }

}
