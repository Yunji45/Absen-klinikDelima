<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPegawai;
use App\Models\User;
use App\Models\DokumenUser;
use App\Models\SertifikatUser;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;


class DetailController extends Controller
{
    public function index($id)
    {
        $title = 'INFORMASI KARYAWAN';
        $data = User::find($id);
        $detail = DetailPegawai::where('user_id', $data->id)->get();
        $existingDetail = DetailPegawai::where('user_id', Auth::user()->id)->first();
        $dokumen = DokumenUser::where('user_id',Auth::user()->id)->get();
        $sertifikat = SertifikatUser::where('user_id',Auth::user()->id)->get();
        $post   = DetailPegawai::whereId($id)->first();
        // return $detail;
        return view ('frontend.users.detail_user.index',compact('title','data','detail','existingDetail','post','dokumen','sertifikat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name'  => ['required', 'max:32', 'string'],
            'place_birth' => ['required'],
            'date_birth' => ['required'],
            'gender'   => 'required',
            'religion'  => ['required'],
            'education'  => 'required',
            'program_study'   => 'required',
            'address'   => 'required',
            'position'   => 'required',
            'phone'   => 'required',
            'email'   => 'required',
            'hire_date'   => 'required',
            'marital_status'   => 'required',
            'spouse_name'   => 'required',
            'number_of_children'   => 'required',
            'hobbies'   => 'required',
            'skills'   => 'required',
        ]);
        $existingDetail = DetailPegawai::where('user_id', $request->user_id)->first();
        if($existingDetail){
            $existingDetail->update([
                'name' => $request->name,
                'place_birth' => $request->place_birth,
                'date_birth' => $request->date_birth,
                'gender'   => $request->gender,
                'religion'  => $request->religion,
                'education'  => $request->education,
                'program_study'   => $request->program_study,
                'address'   => $request->address,
                'position'   => $request->position,
                'phone'   => $request->phone,
                'email'   => $request->email,
                'hire_date'   => $request->hire_date,
                'marital_status'   => $request->marital_status,
                'spouse_name'   => $request->spouse_name,
                'number_of_children'   => $request->number_of_children,
                'hobbies'   => $request->hobbies,
                'skills'   => $request->skills,        
            ]);
            return $existingDetail;
        }else{
            $detail = new DetailPegawai;
            $detail ->user_id = Auth::user()->id;
            $detail ->name = $request->name;
            $detail ->place_birth = $request->place_birth;
            $detail ->date_birth = $request->date_birth;
            $detail ->gender = $request->gender;
            $detail ->religion = $request->religion;
            $detail ->education = $request->education;
            $detail ->program_study = $request->program_study;
            $detail ->address = $request->address;
            $detail ->position = $request->position;
            $detail ->phone = $request->phone;
            $detail ->email = $request->email;
            // Hitung masa kerja
            $hireDate = Carbon::parse($request->hire_date);
            $currentDate = Carbon::now();
            $lengthOfServiceMonths = $hireDate->diffInMonths($currentDate);
            $detail->length_of_service = ($lengthOfServiceMonths < 12) ? 1 : $lengthOfServiceMonths;

            $detail->hire_date = $request->hire_date;
            $detail->exit_date = $request->exit_date ?: null;
            $detail->exit_reason = $request->exit_reason ?: null;
            $detail ->marital_status = $request->marital_status;
            $detail ->spouse_name = $request->spouse_name;
            $detail ->number_of_children = $request->number_of_children;
            $detail ->hobbies = $request->hobbies;
            $detail ->skills = $request->skills;
            $detail ->save();
            return $detail;
        }
        
    }

    public function edit ($id)
    {

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'user_id' => 'required',
            'name'  => ['required'],
            'place_birth' => ['required'],
            'date_birth' => ['required'],
            'gender'   => 'required',
            'religion'  => ['required'],
            'education'  => 'required',
            'program_study'   => 'required',
            'address'   => 'required',
            'position'   => 'required',
            'phone'   => 'required',
            'email'   => 'required',
            'hire_date'   => 'required',
            'marital_status'   => 'required',
            'spouse_name'   => 'required',
            'number_of_children'   => 'required',
            'hobbies'   => 'required',
            'skills'   => 'required',
        ]);
        $detail = DetailPegawai ::findOrFail($id);
        $detail ->name = $request->name;
        $detail ->place_birth = $request->place_birth;
        $detail ->date_birth = $request->date_birth;
        $detail ->gender = $request->gender;
        $detail ->religion = $request->religion;
        $detail ->education = $request->education;
        $detail ->program_study = $request->program_study;
        $detail ->address = $request->address;
        $detail ->position = $request->position;
        $detail ->phone = $request->phone;
        $detail ->email = $request->email;
        $detail ->hire_date = $request->hire_date;
        $detail ->length_of_service = $request->length_of_service;
        $detail ->marital_status = $request->marital_status;
        $detail ->spouse_name = $request->spouse_name;
        $detail ->number_of_children = $request->number_of_children;
        $detail ->hobbies = $request->hobbies;
        $detail ->skills = $request->skills;
        $detail->save();
        return $detail;
    }

    public function destroy($id)
    {

    }

    public function indexAdm()
    {
        $title = 'Detail Pegawai';
        $data = DetailPegawai::all();
        return view ('backend.admin.detail-pegawai.index',compact('title','data'));
    }

    public function delete($id)
    {
        $data = DetailPegawai::findOrFail($id);
        $data ->delete();
        return redirect('/detail-pegawai')->with('success','Data Berhasil Di Hapus');        
    }
    public function show($id)
    {
        $title = 'INFORMASI KARYAWAN';
        $data = User::all();
        // if (!$data) {
        //     return redirect()->route('route_name_for_error_page');
        // }
        $detail = DetailPegawai::find($id);
        $dokumen = DokumenUser::where('user_id', $id)->get();
        $sertifikat = SertifikatUser::where('user_id', $id)->get();
        $post = DetailPegawai::whereId($id)->first();
        // return $detail->user->foto;
        return view ('backend.admin.detail-pegawai.show',compact('title','data','detail','dokumen','post','sertifikat'));
    }

}