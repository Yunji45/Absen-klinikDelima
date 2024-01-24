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
        $title = 'Job Application';
        $type = 'layout';
        $job = JobApplication::orderBy('created_at','desc')->get();
        return view('template.backend.admin.job-application.index',compact('title','type','job'));
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
            'email' => ['required', 'email', function ($attribute, $value, $fail) {
                // Validasi keunikan email secara manual
                $existingEmail = JobApplication::where('email', $value)->exists();
                if ($existingEmail) {
                    $fail('Alamat email sudah digunakan.');
                }
            }],            
            'cover_letter' => 'required',
            'foto' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
            'file_cv' => 'required|file|mimes:pdf|max:2048',
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

        // try {
        //     $imageName = time().'.'.$request->file('foto')->extension();
        //     Storage::putFileAs('public/hiring-foto', $request->file('foto'), $imageName);
        // } catch (\Exception $e) {
        //     \Log::error('Kesalahan unggah file: ' . $e->getMessage());
        //     return redirect()->back()
        //         ->with('errorForm', ['foto' => 'Terjadi kesalahan saat mengunggah file foto'])
        //         ->withInput();
        // }
        try {
            $imageName = time().'.'.$request->file('foto')->extension();
            Storage::putFileAs('public/hiring-foto', $request->file('foto'), $imageName);
        
            $CvName = time().'.'.$request->file('file_cv')->extension();
            Storage::putFileAs('public/hiring-cv', $request->file('file_cv'), $CvName);
        
            // Logika penyimpanan file_pendukung jika diperlukan
            if ($request->hasFile('file_pendukung')) {
                $filePendukungName = time().'.'.$request->file('file_pendukung')->extension();
                Storage::putFileAs('public/hiring-file-pendukung', $request->file('file_pendukung'), $filePendukungName);
            }
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['file' => 'Terjadi kesalahan saat mengunggah file'])
                ->withInput();
        }
        
        $JobApp = new JobApplication;
        $JobApp -> vacancy_id = $request->vacancy_id;
        $JobApp -> nama_lengkap = $request->nama_lengkap;
        $JobApp -> email = $request->email;
        $JobApp -> cover_letter = $request->cover_letter;
        $JobApp -> foto = $imageName;
        $JobApp -> file_cv = $CvName;
        $JobApp -> file_pendukung = $filePendukungName;
        // return $JobApp;
        if ($JobApp){
            $JobApp->save();
            return redirect()->route('frontend')->with('success','Data Lamaran Berhasil Disubmit.');
        }else{
            return redirect()->back()->with('error','Data Lamaran Gagal Disubmit.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Job Application';
        $type = 'layout';
        $detail = JobApplication::find($id);
        return view('template.backend.admin.job-application.view',compact('title','type','detail'));
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
            $jobApplication = JobApplication::find($id);

            if (!$jobApplication) {
                return redirect()->back()->with('error', 'Data Lamaran tidak ditemukan.');
            }

            // Hapus file foto, CV, dan file pendukung dari penyimpanan
            Storage::delete('public/hiring-foto/' . $jobApplication->foto);
            Storage::delete('public/hiring-cv/' . $jobApplication->file_cv);
            
            if ($jobApplication->file_pendukung) {
                Storage::delete('public/hiring-file-pendukung/' . $jobApplication->file_pendukung);
            }
            // Hapus record dari database
            $jobApplication->delete();

            return redirect()->back()->with('success', 'Data Lamaran berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error('Kesalahan menghapus data lamaran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data lamaran.');
        }
    }


    public function index_user()
    {
        $title = 'Formulir Pengajuan CV';
        $job = JobVacancy::all();
        return view('template.frontend.content.formulir-cv',compact('title','job'));
    }
}
