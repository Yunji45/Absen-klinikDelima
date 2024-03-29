<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SertifikatUser;
use App\Models\User;
use Auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('frontend.users.detail_user.sertifikat');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                // Validasi file PDF
                $request->validate([
                    'pdf_files.*' => 'required|mimes:pdf|max:2000', // Batas ukuran: 2MB, tipe file: pdf
                    'image_files.*' => 'required|mimes:jpg,jpeg,png|max:5000', // Batas ukuran: 5MB, tipe file: jpg, jpeg, png
                    ], [
                        'pdf_files.*.required' => 'File PDF harus diunggah.',
                        'pdf_files.*.mimes' => 'File PDF harus memiliki ekstensi .pdf.',
                        'pdf_files.*.max' => 'File PDF tidak boleh lebih dari 2MB.',
                        'image_files.*.required' => 'File gambar (foto) harus diunggah.',
                        'image_files.*.mimes' => 'File gambar (foto) harus memiliki ekstensi .jpg, .jpeg, atau .png.',
                        'image_files.*.max' => 'File gambar (foto) tidak boleh lebih dari 5MB.',
                    ]);
                if ($request->hasFile('pdf_files')) {
                    foreach ($request->file('pdf_files') as $file) {
                        if ($file->isValid()) {
                            $userId = Auth::user()->name; 
        
                            $userFolder = 'storage/app/sertifikat/' . $userId;
                            if (!File::exists($userFolder)) {
                                File::makeDirectory($userFolder, 0755, true, true);
                            }
                            
                            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                            $file->storeAs('public/sertifikat_pegawai/' . $userId, $filename, 'local');
                            
                            // Simpan data dokumen PDF ke database
                            SertifikatUser::create([
                                'user_id' => Auth::id(),
                                'filename' => $filename,
                                'extension' => 'pdf', // Ekstensi PDF
                                'folder' => $userId, 
                            ]);
                        }
                    }
                }
                return redirect('/profil')->with('success','Terimakasih ,Data Berhasil Di Simpan.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $sertifikat = SertifikatUser::find($id);
            if ($sertifikat) {
                $path = 'public/sertifikat_pegawai/' . $sertifikat->user->name . '/' . $sertifikat->filename;
                Storage::delete($path);
                $sertifikat->delete();
                return redirect()->back()->with('success', 'Sertifikat pengguna berhasil dihapus dari database dan storage.');
            } else {
                return redirect()->back()->with('error', 'Sertifikat tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus sertifikat pengguna.');
        }

    }

    public function admsertifikat()
    {
        $title = 'Sertifikat Pegawai';
        $data = SertifikatUser::all();
        return view('backend.admin.sertifikat.sertifikat',compact('data','title'));
    }

}
