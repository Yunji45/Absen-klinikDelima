<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenUser;
use Auth;
use File;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('frontend.users.detail_user.dokumen');
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

                    $userFolder = 'storage/app/pdf/' . $userId;
                    if (!File::exists($userFolder)) {
                        File::makeDirectory($userFolder, 0755, true, true);
                    }
                    
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $file->storeAs('public/dok_pegawai/' . $userId, $filename, 'local');
                    
                    // Simpan data dokumen PDF ke database
                    DokumenUser::create([
                        'user_id' => Auth::id(),
                        'filename' => $filename,
                        'extension' => 'pdf', // Ekstensi PDF
                        'folder' => $userId, 
                    ]);
                }
            }
        }
        return redirect('/profil');
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
        //
    }
}
