<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(),[
            'nama_lengkap' => 'required',
            'email' => 'required',
            'cover_letter' => 'required',
            'foto' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
            'file_cv' => 'required',
        ],[
            'nama_lengkap.required' => 'nama lengkap tidak boleh kosong',
            'email.required' => 'email yang dibutuhkan tidak boleh kosong.',
            'cover_letter.required' => 'Informasi Pendukung wajib di isi.',
            'file_cv.required' => 'CV wajib di upload',
            'foto.required' => 'Foto Wajib Di isi.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $imageName = time().'.'.$request->file('foto')->extension();
            Storage::putFileAs('public/hiring-foto', $request->file('foto'), $imageName);
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['foto' => 'Terjadi kesalahan saat mengunggah file foto'])
                ->withInput();
        }

        $JobApp = new JobApplication;
        $JobApp -> vacancy_id = $request->vacancy_id;
        $JobApp -> nama_lengkap = $request->nama_lengkap;
        $JobApp -> email = $request->email;
        $JobApp -> cover_letter = $request->cover_letter;
        $JobApp -> foto = $imageName;
        $JobApp -> file_cv = $request->file_cv;
        $JobApp -> file_pendukung = $request->file_pendukung;
        return $JobApp;
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

    public function index_user()
    {
        $title = 'Formulir Pengajuan CV';
        $job = JobVacancy::all();
        return view('template.frontend.content.formulir-cv',compact('title','job'));
    }
}
