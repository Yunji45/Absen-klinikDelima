<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Lowongan Pekerjaan';
        $type = 'layout';
        $kode = 'layout-index';
        $job = JobVacancy::orderBy('created_at','desc')->get();
        $count = Jobvacancy::all()->count();
        $Nakes = JobVacancy::where('category','Nakes')->count();
        $NonNakes = JobVacancy::where('category','Non Nakes')->count();
        // return $count;
        return view ('template.backend.admin.job-vacancy.index',compact('title','type','job','count','Nakes','NonNakes','kode'));
    }

    public function index_Nakes()
    {
        $title = 'Lowongan Pekerjaan';
        $type = 'layout';
        $kode = 'layout-index';
        $job = JobVacancy::where('category','Nakes')->orderBy('created_at','desc')->get();
        $count = Jobvacancy::all()->count();
        $Nakes = JobVacancy::where('category','Nakes')->count();
        $NonNakes = JobVacancy::where('category','Non Nakes')->count();
        // return $count;
        return view ('template.backend.admin.job-vacancy.index-nakes',compact('title','type','job','count','Nakes','NonNakes','kode'));

    }

    public function index_Non_Nakes()
    {
        $title = 'Lowongan Pekerjaan';
        $type = 'layout';
        $kode = 'layout-index';
        $job = JobVacancy::where('category','Non Nakes')->orderBy('created_at','desc')->get();
        $count = Jobvacancy::all()->count();
        $Nakes = JobVacancy::where('category','Nakes')->count();
        $NonNakes = JobVacancy::where('category','Non Nakes')->count();
        // return $count;
        return view ('template.backend.admin.job-vacancy.index-non-nakes',compact('title','type','job','count','Nakes','NonNakes','kode'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Pekerjaan';
        $type = 'layout';
        return view ('template.backend.admin.job-vacancy.create',compact('title','type'));
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
            'category' => 'required',
            'position' => 'required',
            'deskripsi' => 'required',
        ],[
            'category.required' => 'category tidak boleh kosong',
            'position.required' => 'posisi yang dibutuhkan tidak boleh kosong.',
            'deskripsi.required' => 'deskripsi tidak boleh kosong.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $job = new JobVacancy;
        $job->category = $request->category;
        $job->position = $request->position;
        $job->deskripsi = $request->deskripsi;
        $job->kualifikasi_1 = $request->kualifikasi_1;
        $job->kualifikasi_2 = $request->kualifikasi_2;
        $job->kualifikasi_3 = $request->kualifikasi_3;
        $job->kualifikasi_4 = $request->kualifikasi_4;
        $job->kualifikasi_5 = $request->kualifikasi_5;
        $job->kualifikasi_6 = $request->kualifikasi_6;
        $job->kualifikasi_7 = $request->kualifikasi_7;
        $job->kualifikasi_8 = $request->kualifikasi_8;
        $job->kualifikasi_9 = $request->kualifikasi_9;
        $job->kualifikasi_10 = $request->kualifikasi_10;
        $job->bulan = Carbon::now()->format('Y-m-d');

        // return $job;
        if ($job){
            $job -> save();
            return redirect()->route('job-vacancy.index')->with('success','Lowongan Pekerjaan Berhasil Di Publish.');
        }else{
            return redirect()->back()->with('error','Lowongan Pekerjaan Gagal Untuk Di Publish.');
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
